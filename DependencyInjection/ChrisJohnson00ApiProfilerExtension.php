<?php

namespace ChrisJohnson00\ApiProfilerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ChrisJohnson00ApiProfilerExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');


        $container->setParameter(
            'chrisjohnson00_apiprofiler.your_parameter',
            isset($$config['chrisjohnson00_apiprofiler']['warning_threshold'])?$$config['chrisjohnson00_apiprofiler']['warning_threshold']:5000
        );
        $container->setParameter(
            'chrisjohnson00_apiprofiler.your_parameter',
            isset($$config['chrisjohnson00_apiprofiler']['error_threshold'])?$$config['chrisjohnson00_apiprofiler']['error_threshold']:10000
        );
    }
}
