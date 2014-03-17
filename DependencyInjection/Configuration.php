<?php

namespace LZAztec\NotificationBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('lz_aztec_notification');

        $rootNode
            ->children()
                ->scalarNode('realplexor_host')->defaultValue('127.0.0.1')->end()
                ->scalarNode('realplexor_port')->defaultValue('10010')->end()
                ->scalarNode('realplexor_ns')->defaultValue('sm_')->end()
                ->scalarNode('js_api_host')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('enabled_adapters')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('realplexor')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
