<?php

namespace Aiapps\ValuationFormBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('aiapps_valuation_form');

        $rootNode
            ->children()
            ->arrayNode('parameters')
            ->children()
            ->scalarNode('apikey')->end()
            ->scalarNode('email')->end()
            ->scalarNode('terms')->end()
            ->end()
            ->end() //parameters
            ->end()
        ;

        return $treeBuilder;
    }
}
