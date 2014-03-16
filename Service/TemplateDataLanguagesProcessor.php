<?php
/**
 * @package atipso_dev
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.03.14
 * @time 10:41
 */

namespace CodeLovers\PhpStormBundle\Service;


use CodeLovers\PhpStormBundle\Model\Component;
use CodeLovers\PhpStormBundle\Model\File;
use CodeLovers\PhpStormBundle\Model\Project;
use JMS\Serializer\Serializer;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class TemplateDataLanguagesProcessor
{
    const PROJECT_DIR_PREFIX = 'file://$PROJECT_DIR$';
    /**
     * folder where your PhpStorm configuration is located
     * typically .idea
     *
     * @var string
     */
    private $configFolder;

    /**
     * project root dir
     *
     * @var string
     */
    private $rootDir;

    /**
     * template data languages to process/add
     *
     * @var array
     */
    private $languages;

    /**
     * the source folders to process
     *
     * @var array
     */
    private $sourceFolders;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * the object graph of the configuration
     *
     * @var Project
     */
    private $project;

    /**
     * map of existing files
     *
     * @var array
     */
    private $existingFiles = array();

    /**
     * reference to the TemplateDataLanguageMappings component we're
     * actually editing
     *
     * @var Component
     */
    private $component;

    /**
     * @param \JMS\Serializer\Serializer $serializer
     * @param string $rootDir
     * @param string $configFolder
     * @param array $languages
     * @param array $sourceFolders
     */
    public function __construct(Serializer $serializer, $rootDir, $configFolder, array $languages, array $sourceFolders)
    {
        $this->serializer = $serializer;
        $this->rootDir = $rootDir;

        if ('/' === substr($configFolder, -1)) {
            $this->configFolder = substr($configFolder, 0, -1);
        } else {
            $this->configFolder = $configFolder;
        }
        $this->languages = $languages;
        $this->sourceFolders = $sourceFolders;
    }

    /**
     * @param OutputInterface $output
     *
     */
    public function run(OutputInterface $output = null)
    {
        $configFile = $this->configFolder . '/templateLanguages.xml';
        $this->initialize($configFile);

        foreach ($this->languages as $language) {
            $finder = new Finder();
            $finder->name($language['pattern']);

            foreach ($this->sourceFolders as $sourceFolder) {
                foreach ($finder->in($sourceFolder) as $file) {
                    /** @var SplFileInfo $file */
                    if (true === $this->addFile($file, $sourceFolder, $language['dialect'])) {
                        if (null !== $output) {
                            $output->writeln(sprintf("<info>added file %s with dialect %s</info>", $file->getFilename(), $language['dialect']));
                        }
                    }
                }
            }
        }

        file_put_contents($configFile, $this->serializer->serialize($this->project, 'xml'));
    }

    /**
     * initializes the existing configuration
     * and prepares the index of existing definitions
     *
     * @param string $configFile
     */
    private function initialize($configFile)
    {
        // process existing configuration
        if (file_exists($configFile)) {
            $this->project = $this->serializer->deserialize(file_get_contents($configFile), 'CodeLovers\PhpStormBundle\Model\Project', 'xml');
        } else {
            $this->project = new Project();
        }
        $this->existingFiles = array();

        foreach ($this->project->getTemplateDataLanguageMappings() as $component) {
            $this->component = $component;
            /** @var Component $component */
            foreach ($component->getFiles() as $file) {
                /** @var File $file */
                $this->existingFiles[$file->getUrl()] = $file->getDialect();
            }
        }
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $file
     * @param string $dialect
     *
     * @return bool
     */
    private function addFile(SplFileInfo $file, $sourcePath, $dialect)
    {
        $url = str_replace($this->rootDir, self::PROJECT_DIR_PREFIX, $sourcePath . '/' . $file->getRelativePathname());

        if (!array_key_exists($url, $this->existingFiles)) {
            $this->component->addFile(new File($dialect, $url));
            $this->existingFiles[$url] = $dialect;

            return true;
        }

        return false;
    }
} 