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
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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

        // Api section
        $this->addApiSection($rootNode);

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
        $this->addDistanceMatrixSection($rootNode);
        $this->addDistanceMatrixRequestSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds the API section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addApiSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('api')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('helper_class')->end()
                        ->arrayNode('libraries')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('html_container')->end()
                        ->scalarNode('async')->end()
                        ->scalarNode('auto_zoom')->end()
                        ->arrayNode('center')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('type')->end()
                        ->scalarNode('zoom')->end()
                        ->scalarNode('width')->end()
                        ->scalarNode('height')->end()
                        ->scalarNode('language')->end()
                        ->arrayNode('map_options')
                            ->useAttributeAsKey('map_options')
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('stylesheet_options')
                            ->useAttributeAsKey('stylesheet_options')
                            ->prototype('scalar')->end()
                        ->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('latitude')->end()
                        ->scalarNode('longitude')->end()
                        ->scalarNode('no_wrap')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('south_west')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->arrayNode('north_east')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('no_wrap')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('x')->end()
                        ->scalarNode('y')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('width')->end()
                        ->scalarNode('height')->end()
                        ->scalarNode('width_unit')->end()
                        ->scalarNode('height_unit')->end()
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
                            ->prototype('scalar')->end()
                        ->end()
                        ->scalarNode('control_position')->end()
                        ->scalarNode('map_type_control_style')->end()
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
                        ->scalarNode('opened')->end()
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
                        ->scalarNode('control_position')->end()
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
                        ->scalarNode('control_position')->end()
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
                        ->scalarNode('control_position')->end()
                        ->scalarNode('scale_control_style')->end()
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
                        ->scalarNode('control_position')->end()
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
                        ->scalarNode('control_position')->end()
                        ->scalarNode('zoom_control_style')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->scalarNode('animation')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('map_options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('url')->end()
                        ->arrayNode('anchor')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('x')->end()
                                ->scalarNode('y')->end()
                            ->end()
                        ->end()
                        ->arrayNode('origin')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('x')->end()
                                ->scalarNode('y')->end()
                            ->end()
                        ->end()
                        ->arrayNode('scaled_size')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('width_unit')->end()
                                ->scalarNode('height_unit')->end()
                            ->end()
                        ->end()
                        ->arrayNode('size')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('width_unit')->end()
                                ->scalarNode('height_unit')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('type')->defaultValue('poly')->end()
                        ->arrayNode('coordinates')
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('position')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->arrayNode('pixel_offset')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('width')->end()
                                ->scalarNode('height')->end()
                                ->scalarNode('width_unit')->end()
                                ->scalarNode('height_unit')->end()
                            ->end()
                        ->end()
                        ->scalarNode('content')->end()
                        ->scalarNode('open')->end()
                        ->scalarNode('auto_open')->end()
                        ->scalarNode('open_event')->end()
                        ->scalarNode('auto_close')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->arrayNode('center')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->scalarNode('radius')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('url')->defaultValue('')->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
                        ->scalarNode('url')->end()
                        ->arrayNode('options')
                            ->useAttributeAsKey('options')
                            ->prototype('scalar')->end()
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
                        ->scalarNode('prefix_javascript_variable')->end()
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
                        ->scalarNode('class')->end()
                        ->scalarNode('fake_ip')->end()
                        ->scalarNode('adapter')->end()
                        ->arrayNode('provider')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->end()
                                ->scalarNode('api_key')->end()
                                ->scalarNode('locale')->end()
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
                        ->scalarNode('address')->end()
                        ->arrayNode('coordinate')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('longitude')->end()
                                ->scalarNode('latitude')->end()
                                ->scalarNode('no_wrap')->end()
                            ->end()
                        ->end()
                        ->arrayNode('bound')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('south_west')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('north_east')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('latitude')->end()
                                        ->scalarNode('longitude')->end()
                                        ->scalarNode('no_wrap')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('region')->end()
                        ->scalarNode('language')->end()
                        ->booleanNode('sensor')->end()
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
                        ->scalarNode('url')->end()
                        ->booleanNode('https')->end()
                        ->scalarNode('format')->end()
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
                        ->scalarNode('avoid_highways')->end()
                        ->scalarNode('avoid_tolls')->end()
                        ->scalarNode('optimize_waypoints')->end()
                        ->scalarNode('provide_route_alternatives')->end()
                        ->scalarNode('region')->end()
                        ->scalarNode('language')->end()
                        ->scalarNode('travel_mode')->end()
                        ->scalarNode('unit_system')->end()
                        ->booleanNode('sensor')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the distance matrix section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addDistanceMatrixSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('distance_matrix')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('url')->end()
                        ->booleanNode('https')->end()
                        ->scalarNode('format')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Adds the distance matrix request section.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node.
     */
    protected function addDistanceMatrixRequestSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('distance_matrix_request')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->end()
                        ->scalarNode('avoid_highways')->end()
                        ->scalarNode('avoid_tolls')->end()
                        ->scalarNode('region')->end()
                        ->scalarNode('language')->end()
                        ->scalarNode('travel_mode')->end()
                        ->scalarNode('unit_system')->end()
                        ->booleanNode('sensor')->end()
                    ->end()
                ->end()
            ->end();
    }
}
