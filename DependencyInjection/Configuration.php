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

use Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\Controls\ScaleControlStyle,
    Ivory\GoogleMap\Controls\ZoomControlStyle,
    Ivory\GoogleMap\MapTypeId,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition,
    Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Ivory google map configuration.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
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
        $this->addControlPositionSection($rootNode);
        $this->addMapTypeControlSection($rootNode);
        $this->addMapTypeControlStyleSection($rootNode);
        $this->addOverviewMapControlSection($rootNode);
        $this->addPanControlSection($rootNode);
        $this->addRotateControlSection($rootNode);
        $this->addScaleControlSection($rootNode);
        $this->addScaleControlStyleSection($rootNode);
        $this->addStreetViewControlSection($rootNode);
        $this->addZoomControlSection($rootNode);
        $this->addZoomControlStyleSection($rootNode);

        // Overlay sections
        $this->addAnimationSection($rootNode);
        $this->addMarkerSection($rootNode);
        $this->addMarkerImageSection($rootNode);
        $this->addMarkerShapeSection($rootNode);
        $this->addInfoWindowSection($rootNode);
        $this->addPolylineSection($rootNode);
        $this->addPolygonSection($rootNode);
        $this->addEncodedPolylineSection($rootNode);
        $this->addRectangleSection($rootNode);
        $this->addCircleSection($rootNode);
        $this->addGroundOverlaySection($rootNode);

        // Layers sections
        $this->addKMLLayerSection($rootNode);

        // Event sections
        $this->addEventManagerSection($rootNode);
        $this->addEventSection($rootNode);

        // Geometry sections
        $this->addEncodingSection($rootNode);

        // Services sections
        $this->addGeocoderSection($rootNode);
        $this->addGeocoderRequestSection($rootNode);
        $this->addDirectionsSection($rootNode);
        $this->addDirectionsRequestSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds the map section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMapSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('map_')->end()
                        ->scalarNode('html_container')->defaultValue('map_canvas')->end()
                        ->scalarNode('async')->defaultFalse()->end()
                        ->scalarNode('auto_zoom')->defaultFalse()->end()
                        ->arrayNode('center')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(null)->end()
                                        ->scalarNode('longitude')->defaultValue(null)->end()
                                        ->scalarNode('no_wrap')->defaultValue(null)->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(null)->end()
                                        ->scalarNode('longitude')->defaultValue(null)->end()
                                        ->scalarNode('no_wrap')->defaultValue(null)->end()
                                    ->end()
                                ->end()
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
                        ->scalarNode('language')->defaultValue('en')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the map type ID section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMapTypeIdSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_id')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the coordinate section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addCoordinateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('coordinate')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('latitude')->defaultValue(0)->end()
                        ->scalarNode('longitude')->defaultValue(0)->end()
                        ->scalarNode('no_wrap')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the bound section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addBoundSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('bound')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('bound_')->end()
                        ->arrayNode('south_west')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('latitude')->defaultValue(null)->end()
                                ->scalarNode('longitude')->defaultValue(null)->end()
                                ->scalarNode('no_wrap')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->arrayNode('north_east')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('latitude')->defaultValue(null)->end()
                                ->scalarNode('longitude')->defaultValue(null)->end()
                                ->scalarNode('no_wrap')->defaultValue(null)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the point section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addPointSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('point')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('x')->defaultValue(0)->end()
                        ->scalarNode('y')->defaultValue(0)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the size section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addSizeSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('size')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('width')->defaultValue(1)->end()
                        ->scalarNode('height')->defaultValue(1)->end()
                        ->scalarNode('width_unit')->defaultValue(null)->end()
                        ->scalarNode('height_unit')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the control position section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addControlPositionSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('control_position')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the map type control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMapTypeControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->arrayNode('map_type_ids')
                            ->defaultValue(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE))
                            ->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_RIGHT)->end()
                        ->scalarNode('map_type_control_style')->defaultValue(MapTypeControlStyle::DEFAULT_)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the map type control style section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMapTypeControlStyleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('map_type_control_style')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the overview map control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addOverviewMapControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('overview_map_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('opened')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the pan control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addPanControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('pan_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the rotate control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addRotateControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('rotate_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the scale control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addScaleControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('scale_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::BOTTOM_LEFT)->end()
                        ->scalarNode('scale_control_style')->defaultValue(ScaleControlStyle::DEFAULT_)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the scale control style section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addScaleControlStyleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('scale_control_style')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the street view control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addStreetViewControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('street_view_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the zoom control section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addZoomControlSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('zoom_control')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('control_position')->defaultValue(ControlPosition::TOP_LEFT)->end()
                        ->scalarNode('zoom_control_style')->defaultValue(ZoomControlStyle::DEFAULT_)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the zoom control style section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addZoomControlStyleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('zoom_control_style')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the animation section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addAnimationSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('animation')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the marker section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMarkerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->scalarNode('animation')->defaultValue(null)->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('map_options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the marker image section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMarkerImageSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker_image')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_image_')->end()
                        ->scalarNode('url')->defaultValue('http://maps.gstatic.com/mapfiles/markers/marker.png')->end()
                        ->arrayNode('anchor')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('x')->defaultValue(null)->end()
                                ->scalarNode('y')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->arrayNode('origin')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('x')->defaultValue(null)->end()
                                ->scalarNode('y')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->arrayNode('scaled_size')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->defaultValue(null)->end()
                                ->scalarNode('height')->defaultValue(null)->end()
                                ->scalarNode('width_unit')->defaultValue(null)->end()
                                ->scalarNode('height_unit')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->arrayNode('size')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->defaultValue(null)->end()
                                ->scalarNode('height')->defaultValue(null)->end()
                                ->scalarNode('width_unit')->defaultValue(null)->end()
                                ->scalarNode('height_unit')->defaultValue(null)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the marker shape section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addMarkerShapeSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('marker_shape')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('marker_shape_')->end()
                        ->scalarNode('type')->defaultValue('poly')->end()
                        ->arrayNode('coordinates')
                            ->defaultValue(array(1, 1, 1, -1, -1, -1, -1, 1))
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the info window section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addInfoWindowSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('info_window')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('info_window_')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(0)->end()
                                ->scalarNode('latitude')->defaultValue(0)->end()
                                ->scalarNode('no_wrap')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->arrayNode('pixel_offset')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->defaultValue(null)->end()
                                ->scalarNode('height')->defaultValue(null)->end()
                                ->scalarNode('width_unit')->defaultValue(null)->end()
                                ->scalarNode('height_unit')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->scalarNode('content')->defaultValue('<p>Default content</p>')->end()
                        ->scalarNode('open')->defaultFalse()->end()
                        ->scalarNode('auto_open')->defaultTrue()->end()
                        ->scalarNode('open_event')->defaultValue('click')->end()
                        ->scalarNode('auto_close')->defaultFalse()->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the polyline section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addPolylineSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('polyline')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('polyline_')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the encoded polyline section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addEncodedPolylineSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('encoded_polyline')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('encoded_polyline_')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the polygon section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addPolygonSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('polygon')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('polygon_')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the rectangle section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addRectangleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('rectangle')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('rectangle_')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(-1)->end()
                                        ->scalarNode('longitude')->defaultValue(-1)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(1)->end()
                                        ->scalarNode('longitude')->defaultValue(1)->end()
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
     * Adds the circle section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addCircleSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('circle')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
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
     * Adds the ground overlay section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addGroundOverlaySection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('ground_overlay')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('ground_overlay_')->end()
                        ->scalarNode('url')->defaultValue('')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(-1)->end()
                                        ->scalarNode('longitude')->defaultValue(-1)->end()
                                        ->scalarNode('no_wrap')->defaultTrue()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(1)->end()
                                        ->scalarNode('longitude')->defaultValue(1)->end()
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
     * Adds the KML layer section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addKMLLayerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('kml_layer')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('kml_layer_')->end()
                        ->scalarNode('url')->defaultValue('')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the event manager section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addEventManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('event_manager')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the event section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addEventSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('event')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('helper_class')->end()
                        ->scalarNode('prefix_javascript_variable')->defaultValue('event_')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the encoding section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addEncodingSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('encoding')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the geocoder section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addGeocoderSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('geocoder')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue(null)->end()
                        ->scalarNode('fake_ip')->defaultValue(null)->end()
                        ->scalarNode('adapter')->defaultValue(null)->end()
                        ->arrayNode('provider')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue(null)->end()
                                ->scalarNode('api_key')->defaultValue(null)->end()
                                ->scalarNode('locale')->defaultValue(null)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the geocoder request section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addGeocoderRequestSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('geocoder_request')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('address')->defaultValue(null)->end()
                        ->arrayNode('coordinate')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->defaultValue(null)->end()
                                ->scalarNode('latitude')->defaultValue(null)->end()
                                ->scalarNode('no_wrap')->defaultValue(null)->end()
                            ->end()
                        ->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(null)->end()
                                        ->scalarNode('longitude')->defaultValue(null)->end()
                                        ->scalarNode('no_wrap')->defaultValue(null)->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->defaultValue(null)->end()
                                        ->scalarNode('longitude')->defaultValue(null)->end()
                                        ->scalarNode('no_wrap')->defaultValue(null)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('region')->defaultValue(null)->end()
                        ->scalarNode('language')->defaultValue(null)->end()
                        ->booleanNode('sensor')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the directions section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addDirectionsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('directions')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('url')->defaultValue('http://maps.googleapis.com/maps/api/directions')->end()
                        ->booleanNode('https')->defaultFalse()->end()
                        ->scalarNode('format')->defaultValue('json')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the directions request section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addDirectionsRequestSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('directions_request')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('avoid_highways')->defaultValue(null)->end()
                        ->scalarNode('avoid_tolls')->defaultValue(null)->end()
                        ->scalarNode('optimize_waypoints')->defaultValue(null)->end()
                        ->scalarNode('provide_route_alternatives')->defaultValue(null)->end()
                        ->scalarNode('region')->defaultValue(null)->end()
                        ->scalarNode('language')->defaultValue(null)->end()
                        ->scalarNode('travel_mode')->defaultValue(null)->end()
                        ->scalarNode('unit_system')->defaultValue(null)->end()
                        ->booleanNode('sensor')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();
    }
}
