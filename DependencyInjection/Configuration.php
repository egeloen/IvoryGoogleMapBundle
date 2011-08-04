<?php

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Ivory google map configuration
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ivory_google_map');

        $this->addMapSection($rootNode);
        $this->addCoordinateSection($rootNode);
        $this->addMarkerSection($rootNode);
        $this->addBoundSection($rootNode);
        $this->addInfoWindowSection($rootNode);
        $this->addPolylineSection($rootNode);
        $this->addPolygonSection($rootNode);
        $this->addRectangleSection($rootNode);
        $this->addCircleSection($rootNode);
        $this->addGroundOverlaySection($rootNode);
        $this->addPointSection($rootNode);
        $this->addSizeSection($rootNode);
        $this->addMarkerImageSection($rootNode);
        $this->addEventManagerSection($rootNode);
        $this->addEventSection($rootNode);
        
        $this->addTwigSection($rootNode);
        
        return $treeBuilder;
    }

    /**
     * Add the map section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMapSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Map')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\MapHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('map_')->end()
                        ->scalarNode('html_container')->defaultValue('map_canvas')->end()
                        ->scalarNode('auto_zoom')->defaultFalse()->end()
                        ->arrayNode('center')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->scalarNode('type')->defaultValue('roadmap')->end()
                        ->scalarNode('zoom')->defaultValue(10)->end()
                        ->scalarNode('width')->defaultValue('300px')->end()
                        ->scalarNode('height')->defaultValue('300px')->end()
                        ->arrayNode('map_options')
                            ->useAttributeAsKey('map_options')->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('stylesheet_options')
                            ->useAttributeAsKey('stylesheet_options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the coordinate section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addCoordinateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('coordinate')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Coordinate')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper')->end()
                        ->scalarNode('latitude')->defaultValue(0)->end()
                        ->scalarNode('longitude')->defaultValue(0)->end()
                        ->scalarNode('no_wrap')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the marker section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMarkerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Marker')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\MarkerHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->scalarNode('icon')->defaultNull()->end()
                        ->scalarNode('shadow')->defaultNull()->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('map_options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the bound section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addBoundSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('bound')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Bound')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\BoundHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('bound_')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the info window section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addInfoWindowSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('info_window')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\InfoWindow')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\InfoWindowHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('info_window_')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->scalarNode('content')->defaultValue('<p>Default content</p>')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('open')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the polyline section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addPolylineSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('polyline')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Polyline')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\PolylineHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('polyline_')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the polygon section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addPolygonSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('polygon')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Polygon')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\PolygonHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('polygon_')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the rectangle section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addRectangleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('rectangle')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Rectangle')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\RectangleHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('rectangle_')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(0)->end()
                                        ->scalarNode('longitude')->defaultValue(0)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(0)->end()
                                        ->scalarNode('longitude')->defaultValue(0)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the circle section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addCircleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('circle')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Circle')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\CircleHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('circle_')->end()
                        ->arrayNode('center')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->scalarNode('radius')->defaultValue(1)->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the ground overlay section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addGroundOverlaySection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('ground_overlay')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\GroundOverlay')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\GroundOverlayHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('ground_overlay_')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(0)->end()
                                        ->scalarNode('longitude')->defaultValue(0)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(0)->end()
                                        ->scalarNode('longitude')->defaultValue(0)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the point section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addPointSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('point')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Point')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\PointHelper')->end()
                        ->scalarNode('x')->defaultValue(0)->end()
                        ->scalarNode('y')->defaultValue(0)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the size section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addSizeSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('size')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Size')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\SizeHelper')->end()
                        ->scalarNode('width')->defaultValue(0)->end()
                        ->scalarNode('height')->defaultValue(0)->end()
                        ->scalarNode('width_unit')->defaultValue(null)->end()
                        ->scalarNode('height_unit')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the marker image section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMarkerImageSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker_image')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\MarkerImage')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\MarkerImageHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_image_')->end()
                        ->scalarNode('url')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the event manager section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addEventManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('event_manager')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\EventManager')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\EventManagerHelper')->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the event section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addEventSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('event')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Event')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\EventHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('event_')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Add the twig section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addTwigSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('twig')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('enabled')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();
    }
}
