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

        $services = [
            'direction'          => true,
            'distance_matrix'    => true,
            'elevation'          => true,
            'geocoder'           => true,
            'place_autocomplete' => true,
            'place_detail'       => true,
            'place_photo'        => false,
            'place_search'       => true,
            'time_zone'          => true,
        ];

        foreach ($services as $service => $http) {
            $children->append($this->createServiceNode($service, $http));
        }

        return $treeBuilder;
    }

    /**
     * @param string $service
     * @param bool   $http
     *
     * @return ArrayNodeDefinition
     */
    private function createServiceNode($service, $http)
    {
        $node = $this->createNode($service);
        $children = $node
            ->children()
            ->scalarNode('api_key')->end()
            ->append($this->createBusinessAccountNode());

        if ($http) {
            $children
                ->scalarNode('client')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('message_factory')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('format')->end();
        } else {
            $node
                ->beforeNormalization()
                    ->ifNull()
                    ->then(function () { return []; })
                ->end();
        }

        return $node;
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
