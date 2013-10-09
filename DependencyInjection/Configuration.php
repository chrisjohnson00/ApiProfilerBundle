<?php

namespace ChrisJohnson00\ApiProfilerBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('chris_johnson00_api_profiler');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->scalarNode('warning_threshold')
                    ->info('Changes the warning threshold time (ms).  This is used to change the toolbar to yellow when the total response time is > this value')
                    ->example("5000")
                    ->defaultValue("5000")
                    ->end()
                ->scalarNode('error_threshold')
                    ->info('Changes the error threshold time (ms).  This is used to change the toolbar to red when the total response time is > this value')
                    ->example("10000")
                    ->defaultValue("10000")
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
