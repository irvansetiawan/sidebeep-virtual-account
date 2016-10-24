<?php

namespace Sidebeep\Service\Infra\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Infrastructure Extension
 * @package Sidebeep\Service\Infra\DependencyInjection
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class InfrastructureExtension extends Extension
{

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('gateways.yml');
        $loader->load('repositories.yml');
        $loader->load('services.yml');
    }
}
