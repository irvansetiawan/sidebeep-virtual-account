<?php

namespace Sidebeep\Service\Infra\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Infrastructure Bundle Configuration
 * @package Sidebeep\Service\Infra\DependencyInjection
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
        $rootNode = $treeBuilder->root('service_infrastructure');
        $rootNode->children()
            ->booleanNode('event')->defaultTrue()->end()
            ->booleanNode('command')->defaultTrue()->end()
        ->end();

        return $treeBuilder;
    }
}
