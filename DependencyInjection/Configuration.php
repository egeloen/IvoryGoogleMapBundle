<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = $this->createTreeBuilder();
        $children = $treeBuilder->root('ivory_google_map')
            ->children()
            ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
            ->scalarNode('language')->defaultValue('%locale%')->end()
            ->scalarNode('api_key')->end();

        foreach (['direction', 'distance_matrix', 'elevation', 'geocoder', 'time_zone'] as $service) {
            $children->append($this->createServiceNode($service));
        }

        return $treeBuilder;
    }

    /**
     * @param string $service
     *
     * @return ArrayNodeDefinition
     */
    private function createServiceNode($service)
    {
        return $this->createNode($service)
            ->children()
                ->scalarNode('client')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('message_factory')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->booleanNode('https')->end()
                ->scalarNode('format')->end()
                ->scalarNode('api_key')->end()
                ->append($this->createBusinessAccountNode())
            ->end();
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createBusinessAccountNode()
    {
        return $this->createNode('business_account')
            ->children()
                ->scalarNode('client_id')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('channel')->end()
            ->end();
    }

    /**
     * @param string $name
     * @param string $type
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    private function createNode($name, $type = 'array')
    {
        return $this->createTreeBuilder()->root($name, $type);
    }

    /**
     * @return TreeBuilder
     */
    private function createTreeBuilder()
    {
        return new TreeBuilder();
    }
}
