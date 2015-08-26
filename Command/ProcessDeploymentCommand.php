<?php
/**
 * @package PhpStormBundle
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 26.08.15
 * @time 12:57
 */

namespace CodeLovers\PhpStormBundle\Command;


use CodeLovers\PhpStormBundle\Service\DeploymentProcessor;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessDeploymentCommand extends ContainerAwareCommand
{
    /**
     * @var DeploymentProcessor
     */
    private $processor;

    protected function configure()
    {
        $this->setName('codelovers:phpstorm:processDeployment')
            ->setAliases(array('codelovers:phpstorm:deployment'))
            ->setDescription('interactive command for setting ignored files/folder in your deployment');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->processor = $this->getContainer()->get('code_lovers_php_storm.deployment');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->processor->run($input, $output, $this->getHelper('question'));
    }
}