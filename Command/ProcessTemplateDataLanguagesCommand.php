<?php
/**
 * @package atipso_dev
 *
 * @author Daniel Holzmann <d@velopment.at>
 * @date 16.03.14
 * @time 11:21
 */

namespace CodeLovers\PhpStormBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessTemplateDataLanguagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('codelovers:phpstorm:processTemplates')
            ->setDescription('Processess all template data languages and updates the config file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $processor = $this->getContainer()->get('code_lovers_php_storm.templatedatalanguages');

        $processor->run($output);
    }
}