<?php

namespace CodeLovers\PhpStormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('code_lovers_php_storm');

        $rootNode
            ->fixXmlConfig('template_data_language')
            ->fixXmlConfig('source_folder')
            ->children()
                ->arrayNode('template_data_languages')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('pattern')->end()
                            ->scalarNode('dialect')->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('config_folder')
                    ->defaultValue('%kernel.root_dir%/../.idea')
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('source_folders')
                    ->requiresAtLeastOneElement()
                    ->addDefaultChildrenIfNoneSet()
                    ->prototype('scalar')->defaultValue('%kernel.root_dir%/../src')->end()
                    ->example(array('%kernel.root_dir%/../src'))
                ->end()
            ->end();

        return $treeBuilder;
    }
}
