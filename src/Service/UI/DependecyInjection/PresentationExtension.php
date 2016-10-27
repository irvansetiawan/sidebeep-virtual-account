<?php

namespace Sidebeep\Service\UI\DependecyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * UI Extentsion
 * @package Sidebeep\Service\UI\DependecyInjection
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class PresentationExtension extends Extension
{

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('controllers.yml');
        $loader->load('application/handlers.yml');
        $loader->load('application/services.yml');
    }
}
