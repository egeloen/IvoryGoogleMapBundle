<?php

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Ivory\GoogleMapBundle\Model\MapTypeId;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

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

        // Map sections
        $this->addMapSection($rootNode);
        $this->addMapTypeIdSection($rootNode);
        
        // Base sections
        $this->addCoordinateSection($rootNode);
        $this->addBoundSection($rootNode);
        $this->addPointSection($rootNode);
        $this->addSizeSection($rootNode);
        
        // Control sections
        $this->addMapTypeControlSection($rootNode);
        $this->addControlPositionSection($rootNode);
        $this->addMapTypeControlStyleSection($rootNode);
        $this->addOverviewMapControlSection($rootNode);
        $this->addPanControlSection($rootNode);
        $this->addRotateControlSection($rootNode);
        
        // Marker sections
        $this->addMarkerSection($rootNode);
        $this->addMarkerImageSection($rootNode);
        $this->addMarkerShapeSection($rootNode);
        
        // Overlay sections
        $this->addInfoWindowSection($rootNode);
        $this->addPolylineSection($rootNode);
        $this->addPolygonSection($rootNode);
        $this->addRectangleSection($rootNode);
        $this->addCircleSection($rootNode);
        $this->addGroundOverlaySection($rootNode);

        // Event sections
        $this->addEventManagerSection($rootNode);
        $this->addEventSection($rootNode);
        
        // Twig section
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
                        ->scalarNode('type')->defaultValue(MapTypeId::ROADMAP)->end()
                        ->scalarNode('zoom')->defaultValue(3)->end()
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
     * Add the map type id section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMapTypeIdSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_id')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Base\Coordinate')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper')->end()
                        ->scalarNode('latitude')->defaultValue(0)->end()
                        ->scalarNode('longitude')->defaultValue(0)->end()
                        ->scalarNode('no_wrap')->defaultTrue()->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Base\Bound')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('bound_')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Base\Point')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Base\PointHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Base\Size')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper')->end()
                        ->scalarNode('width')->defaultValue(1)->end()
                        ->scalarNode('height')->defaultValue(1)->end()
                        ->scalarNode('width_unit')->defaultValue(null)->end()
                        ->scalarNode('height_unit')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the map type control section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMapTypeControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Controls\MapTypeControl')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlHelper')->end()
                        ->scalarNode('map_type_ids')->defaultValue(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE))->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_RIGHT)->end()
                        ->scalarNode('map_type_control_style')->defaultValue(MapTypeControlStyle::DEFAULT_)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the control position section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addControlPositionSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('control_position')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper')->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the map type control style section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMapTypeControlStyleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_control_style')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlStyleHelper')->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the overview map control section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addOverviewMapControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('overview_map_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\OverviewMapControlHelper')->end()
                        ->scalarNode('opened')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the pan control section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addPanControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pan_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Controls\PanControl')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\PanControlHelper')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the rotate control section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addRotateControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('rotate_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Controls\RotateControl')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Controls\RotateControlHelper')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\Marker')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('map_options')->prototype('scalar')->end()
                        ->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\MarkerImage')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerImageHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_image_')->end()
                        ->scalarNode('url')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }
    
    /**
     * Add the marker shape section
     *
     * @param Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    protected function addMarkerShapeSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker_shape')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\MarkerShape')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerShapeHelper')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_shape_')->end()
                        ->scalarNode('type')->defaultValue('poly')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\InfoWindow')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\Polyline')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\Polygon')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolygonHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\Rectangle')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\RectangleHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\Circle')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper')->end()
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
                        ->scalarNode('class')->defaultValue('Ivory\GoogleMapBundle\Model\Overlays\GroundOverlay')->end()
                        ->scalarNode('helper')->defaultValue('Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper')->end()
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
