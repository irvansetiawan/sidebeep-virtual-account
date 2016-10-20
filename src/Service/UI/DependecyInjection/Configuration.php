<?php

namespace Sidebeep\Service\UI\DependecyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * UI Bundle Configuration
 * @package Sidebeep\Service\UI\DependecyInjection
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('service_ui_bundle');

        return $treeBuilder;
    }
}
