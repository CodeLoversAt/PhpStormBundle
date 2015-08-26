<?php
/**
 * @package PhpStormBundle
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 26.08.15
 * @time 12:57
 */

namespace CodeLovers\PhpStormBundle\Service;


use CodeLovers\PhpStormBundle\Model\Component;
use CodeLovers\PhpStormBundle\Model\ExcludedPath;
use CodeLovers\PhpStormBundle\Model\LocalExcludedPath;
use CodeLovers\PhpStormBundle\Model\Mapping;
use CodeLovers\PhpStormBundle\Model\Paths;
use CodeLovers\PhpStormBundle\Model\Project;
use CodeLovers\PhpStormBundle\Model\ServerData;
use CodeLovers\PhpStormBundle\Model\ServerEntry;
use JMS\Serializer\Serializer;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class DeploymentProcessor
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var string
     */
    private $configFolder;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var array
     */
    private $existingPaths;

    /**
     * @var ServerEntry
     */
    private $entry;

    /**
     * DeploymentProcessor constructor.
     * @param Serializer $serializer
     * @param string $rootDir
     * @param string $configFolder
     */
    public function __construct(Serializer $serializer, $rootDir, $configFolder)
    {
        $this->serializer = $serializer;
        $this->rootDir = $rootDir;

        $this->configFolder = preg_replace('/\/$/', '', $configFolder);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param QuestionHelper $helper
     */
    public function run(InputInterface $input, OutputInterface $output, QuestionHelper $helper)
    {
        $configFile = $this->configFolder . '/deployment.xml';
        $this->initialize($configFile);

        $defaultPaths = array(
            'app/config/parameters.yml',
            'app/cache',
            'app/logs',
            'vendor',
            'web/bundles',
            'node_modules',
        );

        foreach ($defaultPaths as $defaultPath) {
            $this->addDefaultPath($defaultPath, $input, $output, $helper);
        }

        $this->addPathManually($input, $output, $helper);

        file_put_contents($configFile, $this->serializer->serialize($this->project, 'xml'));

        $output->writeln(sprintf('<info>excluded paths have been written to %s</info>', $configFile));
    }

    /**
     * initializes the existing configuration
     *
     * @param string $configFile
     */
    private function initialize($configFile)
    {
        if (file_exists($configFile)) {
            $this->project = $this->serializer->deserialize(file_get_contents($configFile), 'CodeLovers\PhpStormBundle\Model\Project', 'xml');
        } else {
            $this->project = new Project();
        }

        $this->existingPaths = array();

        foreach ($this->project->getPublishConfigData() as $component) {
            /** @var Component $component */

            foreach ($component->getServerData() as $serverData) {
                /** @var ServerData $serverData */
                foreach ($serverData->getPaths() as $paths) {
                    /** @var Paths $paths */
                    foreach ($paths->getEntries() as $entry) {
                        /** @var ServerEntry $entry */
                        $this->entry = $entry;

                        foreach ($entry->getExcludedPaths() as $idx=>$excludedPath) {
                            /** @var ExcludedPath $excludedPath */
                            $this->existingPaths[$excludedPath->getPath()] = true;
                        }
                    }
                }
            }
        }
    }

    /**
     * @param string $defaultPath
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param QuestionHelper $helper
     *
     */
    private function addDefaultPath($defaultPath, InputInterface $input, OutputInterface $output, QuestionHelper $helper)
    {
        if (!file_exists($this->rootDir . '/' . $defaultPath) || array_key_exists($defaultPath, $this->existingPaths)) {
            return;
        }

        $question = new ConfirmationQuestion(sprintf('Add the default path <info>%s</info>? (Y/n) ', $defaultPath));

        if ($helper->ask($input, $output, $question)) {
            $this->addPath($defaultPath, $output);
        }
    }

    /**
     * @param string $path
     *
     */
    private function addPath($path, OutputInterface $output)
    {
        $this->entry->addExcludedPath(new ExcludedPath(
            $path
        ));
        $this->entry->addExcludedPath(new ExcludedPath(
            '$PROJECT_DIR$/' . $path,
            'true'
        ));

        $output->writeln(sprintf('<info>path %s has been added</info>', $path));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param QuestionHelper $helper
     *
     */
    private function addPathManually(InputInterface $input, OutputInterface $output, QuestionHelper $helper)
    {
        $output->writeln('Please enter a path you want to add, relative to the project root');
        $question = new Question('(enter an empty path to quit) ');

        if (($path = $helper->ask($input, $output, $question))) {
            $this->addPath($path, $output);
            $this->addPathManually($input, $output, $helper);
        }
    }
}