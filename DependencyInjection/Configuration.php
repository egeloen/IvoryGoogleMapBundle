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
            ->append($this->createMapNode())
            ->append($this->createStaticMapNode());

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
     * @return ArrayNodeDefinition
     */
    private function createMapNode()
    {
        return $this->createNode('map')
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('debug')->defaultValue('%kernel.debug%')->end()
                ->scalarNode('language')->defaultValue('%locale%')->end()
                ->scalarNode('api_key')->end()
            ->end();
    }

    /**
     * @return ArrayNodeDefinition
     */
    private function createStaticMapNode()
    {
        return $this->createNode('static_map')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('api_key')->end()
                ->append($this->createBusinessAccountNode(false))
            ->end();
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
            ->append($this->createBusinessAccountNode(true));

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
                    ->then(function () {
                        return [];
                    })
                ->end();
        }

        return $node;
    }

    /**
     * @param bool $service
     *
     * @return ArrayNodeDefinition
     */
    private function createBusinessAccountNode($service)
    {
        $node = $this->createNode('business_account');
        $clientIdNode = $node->children()
            ->scalarNode('secret')
                ->isRequired()
                ->cannotBeEmpty()
            ->end()
            ->scalarNode('channel')->end()
            ->scalarNode('client_id');

        if ($service) {
            $clientIdNode
                ->isRequired()
                ->cannotBeEmpty();
        }

        return $node;
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
