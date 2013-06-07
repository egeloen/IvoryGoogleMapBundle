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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Ivory google map extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $resources = array(
            'api.xml',
            'base.xml',
            'controls.xml',
            'events.xml',
            'layers.xml',
            'overlays.xml',
            'services.xml',
            'map.xml',
            'twig.xml',
            'helper.xml',
        );

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services/'));
        foreach ($resources as $resource) {
            $loader->load($resource);
        }

        // Api section
        $this->loadApi($config, $container);

        // Map sections
        $this->loadMap($config, $container);
        $this->loadMapTypeId($config, $container);

        // Base sections
        $this->loadCoordinate($config, $container);
        $this->loadBound($config, $container);
        $this->loadPoint($config, $container);
        $this->loadSize($config, $container);

        // Control sections
        $this->loadControlPosition($config, $container);
        $this->loadMapTypeControl($config, $container);
        $this->loadMapTypeControlStyle($config, $container);
        $this->loadOverviewMapControl($config, $container);
        $this->loadPanControl($config, $container);
        $this->loadRotateControl($config, $container);
        $this->loadScaleControl($config, $container);
        $this->loadScaleControlStyle($config, $container);
        $this->loadStreetViewControl($config, $container);
        $this->loadZoomControl($config, $container);
        $this->loadZoomControlStyle($config, $container);

        // Overlay sections
        $this->loadAnimation($config, $container);
        $this->loadMarker($config, $container);
        $this->loadMarkerImage($config, $container);
        $this->loadMarkerShape($config, $container);
        $this->loadInfoWindow($config, $container);
        $this->loadPolyline($config, $container);
        $this->loadEncodedPolyline($config, $container);
        $this->loadPolygon($config, $container);
        $this->loadRectangle($config, $container);
        $this->loadCircle($config, $container);
        $this->loadGroundOverlay($config, $container);

        // Layers sections
        $this->loadKMLLayer($config, $container);

        // Event sections
        $this->loadEventManager($config, $container);
        $this->loadEvent($config, $container);

        // Geometry sections
        $this->loadEncoding($config, $container);

        // Services sections
        $this->loadGeocoder($config, $container);
        $this->loadGeocoderFakeRequest($config, $container);
        $this->loadGeocoderRequest($config, $container);
        $this->loadDirections($config, $container);
        $this->loadDirectionsRequest($config, $container);
        $this->loadDistanceMatrix($config, $container);
        $this->loadDistanceMatrixRequest($config, $container);
    }

    /**
     * Loads API configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadApi(array $config, ContainerBuilder $container)
    {
        if (isset($config['api']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.api')
                ->setClass($config['api']['helper_class']);
        }

        if (isset($config['api']['libraries'])) {
            $container
                ->getDefinition('ivory_google_map.map.builder')
                ->addMethodCall('setLibraries', array($config['api']['libraries']));
        }
    }

    /**
     * Loads map configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMap(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.map.builder');

        if (isset($config['map']['class'])) {
            $builderDefinition->replaceArgument(0, $config['map']['class']);
        }

        if (isset($config['map']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.map')
                ->setClass($config['map']['helper_class']);
        }

        if (isset($config['map']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['map']['prefix_javascript_variable'])
            );
        }

        if (isset($config['map']['html_container'])) {
            $builderDefinition->addMethodCall('setHtmlContainerId', array($config['map']['html_container']));
        }

        if (isset($config['map']['async'])) {
            $builderDefinition->addMethodCall('setAsync', array($config['map']['async']));
        }

        if (isset($config['map']['auto_zoom'])) {
            $builderDefinition->addMethodCall('setAutoZoom', array($config['map']['auto_zoom']));
        }

        if (isset($config['map']['center']['latitude']) && isset($config['map']['center']['longitude'])) {
            $center = array($config['map']['center']['latitude'], $config['map']['center']['longitude']);

            if (isset($config['map']['center']['no_wrap'])) {
                $center[] = $config['map']['center']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setCenter', $center);
        }

        if (isset($config['map']['bound']['south_west']['latitude'])
            && isset($config['map']['bound']['south_west']['longitude'])
            && isset($config['map']['bound']['north_east']['latitude'])
            && isset($config['map']['bound']['north_east']['longitude'])) {
            $bound = array(
                $config['map']['bound']['south_west']['latitude'],
                $config['map']['bound']['south_west']['longitude'],
                $config['map']['bound']['north_east']['latitude'],
                $config['map']['bound']['north_east']['longitude'],
            );

            if (isset($config['map']['bound']['south_west']['no_wrap'])
                && isset($config['map']['bound']['north_east']['no_wrap'])) {
                $bound = array_merge(
                    $bound,
                    array(
                        $config['map']['bound']['south_west']['no_wrap'],
                        $config['map']['bound']['north_east']['no_wrap'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setBound', $bound);
        }

        if (isset($config['map']['language'])) {
            $builderDefinition->addMethodCall('setLanguage', array($config['map']['language']));
        }

        $mapOptions = array();

        if (isset($config['map']['type'])) {
            $mapOptions['mapTypeId'] = $config['map']['type'];
        }

        if (isset($config['map']['zoom'])) {
            $mapOptions['zoom'] = $config['map']['zoom'];
        }

        if (isset($config['map']['map_options'])) {
            $mapOptions = array_merge($config['map']['map_options'], $mapOptions);
        }

        if (!empty($mapOptions)) {
            $builderDefinition->addMethodCall('setMapOptions', array($mapOptions));
        }

        $stylesheetOptions = array();

        if (isset($config['map']['width'])) {
            $stylesheetOptions['width'] = $config['map']['width'];
        }

        if (isset($config['map']['height'])) {
            $stylesheetOptions['height'] = $config['map']['height'];
        }

        if (isset($config['map']['stylesheet_options'])) {
            $stylesheetOptions = array_merge($config['map']['stylesheet_options'], $stylesheetOptions);
        }

        if (!empty($stylesheetOptions)) {
            $builderDefinition->addMethodCall('setStylesheetOptions', array($stylesheetOptions));
        }
    }

    /**
     * Loads map type ID configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMapTypeId(array $config, ContainerBuilder $container)
    {
        if (isset($config['map_type_id']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.map_type_id')
                ->setClass($config['map_type_id']['helper_class']);
        }
    }

    /**
     * Loads coordinate configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadCoordinate(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.coordinate.builder');

        if (isset($config['coordinate']['class'])) {
            $builderDefinition->replaceArgument(0, $config['coordinate']['class']);
        }

        if (isset($config['coordinate']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.coordinate')
                ->setClass($config['coordinate']['helper_class']);
        }

        if (isset($config['coordinate']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['coordinate']['prefix_javascript_variable'])
            );
        }

        if (isset($config['coordinate']['latitude'])) {
            $builderDefinition->addMethodCall('setLatitude', array($config['coordinate']['latitude']));
        }

        if (isset($config['coordinate']['longitude'])) {
            $builderDefinition->addMethodCall('setLongitude', array($config['coordinate']['longitude']));
        }

        if (isset($config['coordinate']['no_wrap'])) {
            $builderDefinition->addMethodCall('setNoWrap', array($config['coordinate']['no_wrap']));
        }
    }

    /**
     * Loads bound configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadBound(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.bound.builder');

        if (isset($config['bound']['class'])) {
            $builderDefinition->replaceArgument(0, $config['bound']['class']);
        }

        if (isset($config['bound']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.bound')
                ->setClass($config['bound']['helper_class']);
        }

        if (isset($config['bound']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['bound']['prefix_javascript_variable'])
            );
        }

        if (isset($config['bound']['south_west']['latitude']) && isset($config['bound']['south_west']['longitude'])) {
            $southWest = array(
                $config['bound']['south_west']['latitude'],
                $config['bound']['south_west']['longitude'],
            );

            if (isset($config['bound']['south_west']['no_wrap'])) {
                $southWest[] = $config['bound']['south_west']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setSouthWest', $southWest);
        }

        if (isset($config['bound']['north_east']['latitude']) && isset($config['bound']['north_east']['longitude'])) {
            $northEast = array(
                $config['bound']['north_east']['latitude'],
                $config['bound']['north_east']['longitude']
            );

            if (isset($config['bound']['north_east']['no_wrap'])) {
                $northEast[] = $config['bound']['north_east']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setNorthEast', $northEast);
        }
    }

    /**
     * Loads point configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPoint(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.point.builder');

        if (isset($config['point']['class'])) {
            $builderDefinition->setArguments(array($config['point']['class']));
        }

        if (isset($config['point']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.point')
                ->setClass($config['point']['helper_class']);
        }

        if (isset($config['point']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['point']['prefix_javascript_variable'])
            );
        }

        if (isset($config['point']['x'])) {
            $builderDefinition->addMethodCall('setX', array($config['point']['x']));
        }

        if (isset($config['point']['y'])) {
            $builderDefinition->addMethodCall('setY', array($config['point']['y']));
        }
    }

    /**
     * Loads size configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadSize(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.size.builder');

        if (isset($config['size']['class'])) {
            $builderDefinition->setArguments(array($config['size']['class']));
        }

        if (isset($config['size']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.size')
                ->setClass($config['size']['helper_class']);
        }

        if (isset($config['size']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['size']['prefix_javascript_variable'])
            );
        }

        if (isset($config['size']['width'])) {
            $builderDefinition->addMethodCall('setWidth', array($config['size']['width']));
        }

        if (isset($config['size']['height'])) {
            $builderDefinition->addMethodCall('setHeight', array($config['size']['height']));
        }

        if (isset($config['size']['width_unit'])) {
            $builderDefinition->addMethodCall('setWidthUnit', array($config['size']['width_unit']));
        }

        if (isset($config['size']['height_unit'])) {
            $builderDefinition->addMethodCall('setHeightUnit', array($config['size']['height_unit']));
        }
    }

    /**
     * Loads control position configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadControlPosition(array $config, ContainerBuilder $container)
    {
        if (isset($config['control_position']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.control_position')
                ->setClass($config['control_position']['helper_class']);
        }
    }

    /**
     * Loads map type control configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMapTypeControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.map_type_control.builder');

        if (isset($config['map_type_control']['class'])) {
            $builderDefinition->setArguments(array($config['map_type_control']['class']));
        }

        if (isset($config['map_type_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.map_type_control')
                ->setClass($config['map_type_control']['helper_class']);
        }

        if (isset($config['map_type_control']['map_type_ids'])) {
            $builderDefinition->addMethodCall('setMapTypeIds', array($config['map_type_control']['map_type_ids']));
        }

        if (isset($config['map_type_control']['control_position'])) {
            $builderDefinition->addMethodCall(
                'setControlPosition',
                array($config['map_type_control']['control_position'])
            );
        }

        if (isset($config['map_type_control']['map_type_control_style'])) {
            $builderDefinition->addMethodCall(
                'setMapTypeControlStyle',
                array($config['map_type_control']['map_type_control_style'])
            );
        }
    }

    /**
     * Loads map type control style configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMapTypeControlStyle(array $config, ContainerBuilder $container)
    {
        if (isset($config['map_type_control_style']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.map_type_control_style')
                ->setClass($config['map_type_control_style']['helper_class']);
        }
    }

    /**
     * Loads overview map control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadOverviewMapControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.overview_map_control.builder');

        if (isset($config['overview_map_control']['class'])) {
            $builderDefinition->setArguments(array($config['overview_map_control']['class']));
        }

        if (isset($config['overview_map_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.overview_map_control')
                ->setClass($config['overview_map_control']['helper_class']);
        }

        if (isset($config['overview_map_control']['opened'])) {
            $builderDefinition->addMethodCall('setOpened', array($config['overview_map_control']['opened']));
        }
    }

    /**
     * Loads pan control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPanControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.pan_control.builder');

        if (isset($config['pan_control']['class'])) {
            $builderDefinition->setArguments(array($config['pan_control']['class']));
        }

        if (isset($config['pan_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.pan_control')
                ->setClass($config['pan_control']['helper_class']);
        }

        if (isset($config['pan_control']['control_position'])) {
            $builderDefinition->addMethodCall('setControlPosition', array($config['pan_control']['control_position']));
        }
    }

    /**
     * Loads rotate control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadRotateControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.rotate_control.builder');

        if (isset($config['rotate_control']['class'])) {
            $builderDefinition->setArguments(array($config['rotate_control']['class']));
        }

        if (isset($config['rotate_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.rotate_control')
                ->setClass($config['rotate_control']['helper_class']);
        }

        if (isset($config['rotate_control']['control_position'])) {
            $builderDefinition->addMethodCall(
                'setControlPosition',
                array($config['rotate_control']['control_position'])
            );
        }
    }

    /**
     * Loads scale control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadScaleControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.scale_control.builder');

        if (isset($config['scale_control']['class'])) {
            $builderDefinition->setArguments(array($config['scale_control']['class']));
        }

        if (isset($config['scale_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.scale_control')
                ->setClass($config['scale_control']['helper_class']);
        }

        if (isset($config['scale_control']['control_position'])) {
            $builderDefinition->addMethodCall(
                'setControlPosition',
                array($config['scale_control']['control_position'])
            );
        }

        if (isset($config['scale_control']['scale_control_style'])) {
            $builderDefinition->addMethodCall(
                'setScaleControlStyle',
                array($config['scale_control']['scale_control_style'])
            );
        }
    }

    /**
     * Loads scale control style configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadScaleControlStyle(array $config, ContainerBuilder $container)
    {
        if (isset($config['scale_control_style']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.scale_control_style')
                ->setClass($config['scale_control_style']['helper_class']);
        }
    }

    /**
     * Loads street view control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadStreetViewControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.street_view_control.builder');

        if (isset($config['street_view_control']['class'])) {
            $builderDefinition->setArguments(array($config['street_view_control']['class']));
        }

        if (isset($config['street_view_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.street_view_control')
                ->setClass($config['street_view_control']['helper_class']);
        }

        if (isset($config['street_view_control']['control_position'])) {
            $builderDefinition->addMethodCall(
                'setControlPosition',
                array($config['street_view_control']['control_position'])
            );
        }
    }

    /**
     * Loads zoom control configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadZoomControl(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.zoom_control.builder');

        if (isset($config['zoom_control']['class'])) {
            $builderDefinition->setArguments(array($config['zoom_control']['class']));
        }

        if (isset($config['zoom_control']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.zoom_control')
                ->setClass($config['zoom_control']['helper_class']);
        }

        if (isset($config['zoom_control']['control_position'])) {
            $builderDefinition->addMethodCall(
                'setControlPosition',
                array($config['zoom_control']['control_position'])
            );
        }

        if (isset($config['zoom_control']['zoom_control_style'])) {
            $builderDefinition->addMethodCall(
                'setZoomControlStyle',
                array($config['zoom_control']['zoom_control_style'])
            );
        }
    }

    /**
     * Loads zoom control style configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadZoomControlStyle(array $config, ContainerBuilder $container)
    {
        if (isset($config['zoom_control_style']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.zoom_control_style')
                ->setClass($config['zoom_control_style']['helper_class']);
        }
    }

    /**
     * Loads animation configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadAnimation(array $config, ContainerBuilder $container)
    {
        if (isset($config['animation']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.animation')
                ->setClass($config['animation']['helper_class']);
        }
    }

    /**
     * Loads marker configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarker(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.marker.builder');

        if (isset($config['marker']['class'])) {
            $builderDefinition->replaceArgument(0, $config['marker']['class']);
        }

        if (isset($config['marker']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker')
                ->setClass($config['marker']['helper_class']);
        }

        if (isset($config['marker']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['marker']['prefix_javascript_variable'])
            );
        }

        if (isset($config['marker']['position']['latitude']) && $config['marker']['position']['longitude']) {
            $position = array($config['marker']['position']['latitude'], $config['marker']['position']['longitude']);

            if (isset($config['marker']['position']['no_wrap'])) {
                $position[] = $config['marker']['position']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setPosition', $position);
        }

        if (isset($config['marker']['animation'])) {
            $builderDefinition->addMethodCall('setAnimation', array($config['marker']['animation']));
        }

        if (isset($config['marker']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['marker']['options']));
        }
    }

    /**
     * Loads marker image configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarkerImage(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.marker_image.builder');

        if (isset($config['marker_image']['class'])) {
            $builderDefinition->replaceArgument(0, $config['marker_image']['class']);
        }

        if (isset($config['marker_image']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker_image')
                ->setClass($config['marker_image']['helper_class']);
        }

        if (isset($config['marker_image']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['marker_image']['prefix_javascript_variable'])
            );
        }

        if (isset($config['marker_image']['url'])) {
            $builderDefinition->addMethodCall('setUrl', array($config['marker_image']['url']));
        }

        if (isset($config['marker_image']['anchor']['x']) && isset($config['marker_image']['anchor']['y'])) {
            $builderDefinition->addMethodCall(
                'setAnchor',
                array($config['marker_image']['anchor']['x'], $config['marker_image']['anchor']['y'])
            );
        }

        if (isset($config['marker_image']['origin']['x']) && isset($config['marker_image']['origin']['y'])) {
            $builderDefinition->addMethodCall(
                'setOrigin',
                array($config['marker_image']['origin']['x'], $config['marker_image']['origin']['y'])
            );
        }

        if (isset($config['marker_image']['scaled_size']['width'])
            && isset($config['marker_image']['scaled_size']['height'])) {
            $scaledSize = array(
                $config['marker_image']['scaled_size']['width'],
                $config['marker_image']['scaled_size']['height'],
            );

            if (isset($config['marker_image']['scaled_size']['width_unit'])
                && isset($config['marker_image']['scaled_size']['height_unit'])) {
                $scaledSize = array_merge(
                    $scaledSize,
                    array(
                        $config['marker_image']['scaled_size']['width_unit'],
                        $config['marker_image']['scaled_size']['height_unit'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setScaledSize', $scaledSize);
        }

        if (isset($config['marker_image']['size']['width'])
            && isset($config['marker_image']['size']['height'])) {
            $size = array(
                $config['marker_image']['size']['width'],
                $config['marker_image']['size']['height'],
            );

            if (isset($config['marker_image']['size']['width_unit'])
                && isset($config['marker_image']['size']['height_unit'])) {
                $size = array_merge(
                    $size,
                    array(
                        $config['marker_image']['size']['width_unit'],
                        $config['marker_image']['size']['height_unit'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setSize', $size);
        }
    }

    /**
     * Loads marker shape configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarkerShape(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.marker_shape.builder');

        if (isset($config['marker_shape']['class'])) {
            $builderDefinition->setArguments(array($config['marker_shape']['class']));
        }

        if (isset($config['marker_shape']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker_shape')
                ->setClass($config['marker_shape']['helper_class']);
        }

        if (isset($config['marker_shape']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['marker_shape']['prefix_javascript_variable'])
            );
        }

        if (isset($config['marker_shape']['type'])) {
            $builderDefinition->addMethodCall('setType', array($config['marker_shape']['type']));
        }

        if (isset($config['marker_shape']['coordinates'])) {
            $builderDefinition->addMethodCall('setCoordinates', array($config['marker_shape']['coordinates']));
        }
    }

    /**
     * Loads info window configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadInfoWindow(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.info_window.builder');

        if (isset($config['info_window']['class'])) {
            $builderDefinition->replaceArgument(0, $config['info_window']['class']);
        }

        if (isset($config['info_window']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.info_window')
                ->setClass($config['info_window']['helper_class']);
        }

        if (isset($config['info_window']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['info_window']['prefix_javascript_variable'])
            );
        }

        if (isset($config['info_window']['position']['latitude'])
            && isset($config['info_window']['position']['longitude'])) {
            $position = array(
                $config['info_window']['position']['latitude'],
                $config['info_window']['position']['longitude'],
            );

            if (isset($config['info_window']['position']['no_wrap'])) {
                $position[] = $config['info_window']['position']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setPosition', $position);
        }

        if (isset($config['info_window']['pixel_offset']['width'])
            && isset($config['info_window']['pixel_offset']['height'])) {
            $pixelOffset = array(
                $config['info_window']['pixel_offset']['width'],
                $config['info_window']['pixel_offset']['height'],
            );

            if (isset($config['info_window']['pixel_offset']['width_unit'])
                && isset($config['info_window']['pixel_offset']['height_unit'])) {
                $pixelOffset = array_merge(
                    $pixelOffset,
                    array(
                        $config['info_window']['pixel_offset']['width_unit'],
                        $config['info_window']['pixel_offset']['height_unit'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setPixelOffset', $pixelOffset);
        }

        if (isset($config['info_window']['content'])) {
            $builderDefinition->addMethodCall('setContent', array($config['info_window']['content']));
        }

        if (isset($config['info_window']['open'])) {
            $builderDefinition->addMethodCall('setOpen', array($config['info_window']['open']));
        }

        if (isset($config['info_window']['auto_open'])) {
            $builderDefinition->addMethodCall('setAutoOpen', array($config['info_window']['auto_open']));
        }

        if (isset($config['info_window']['open_event'])) {
            $builderDefinition->addMethodCall('setOpenEvent', array($config['info_window']['open_event']));
        }

        if (isset($config['info_window']['auto_close'])) {
            $builderDefinition->addMethodCall('setAutoClose', array($config['info_window']['auto_close']));
        }

        if (isset($config['info_window']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['info_window']['options']));
        }
    }

    /**
     * Loads polyline configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPolyline(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.polyline.builder');

        if (isset($config['polyline']['class'])) {
            $builderDefinition->setArguments(array($config['polyline']['class']));
        }

        if (isset($config['polyline']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.polyline')
                ->setClass($config['polyline']['helper_class']);
        }

        if (isset($config['polyline']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['polyline']['prefix_javascript_variable'])
            );
        }

        if (isset($config['polyline']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['polyline']['options']));
        }
    }

    /**
     * Loads encoded polyline configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEncodedPolyline(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.encoded_polyline.builder');

        if (isset($config['encoded_polyline']['class'])) {
            $builderDefinition->setArguments(array($config['encoded_polyline']['class']));
        }

        if (isset($config['encoded_polyline']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.encoded_polyline')
                ->setClass($config['encoded_polyline']['helper_class']);
        }

        if (isset($config['encoded_polyline']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['encoded_polyline']['prefix_javascript_variable'])
            );
        }

        if (isset($config['encoded_polyline']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['encoded_polyline']['options']));
        }
    }

    /**
     * Loads polygon configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPolygon(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.polygon.builder');

        if (isset($config['polygon']['class'])) {
            $builderDefinition->setArguments(array($config['polygon']['class']));
        }

        if (isset($config['polygon']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.polygon')
                ->setClass($config['polygon']['helper_class']);
        }

        if (isset($config['polygon']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['polygon']['prefix_javascript_variable'])
            );
        }

        if (isset($config['polygon']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['polygon']['options']));
        }
    }

    /**
     * Loads rectangle configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadRectangle(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.rectangle.builder');

        if (isset($config['rectangle']['class'])) {
            $builderDefinition->replaceArgument(0, $config['rectangle']['class']);
        }

        if (isset($config['rectangle']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.rectangle')
                ->setClass($config['rectangle']['helper_class']);
        }

        if (isset($config['rectangle']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['rectangle']['prefix_javascript_variable'])
            );
        }

        if (isset($config['rectangle']['bound']['south_west']['latitude'])
            && isset($config['rectangle']['bound']['south_west']['longitude'])
            && isset($config['rectangle']['bound']['north_east']['latitude'])
            && isset($config['rectangle']['bound']['north_east']['longitude'])) {
            $bound = array(
                $config['rectangle']['bound']['south_west']['latitude'],
                $config['rectangle']['bound']['south_west']['longitude'],
                $config['rectangle']['bound']['north_east']['latitude'],
                $config['rectangle']['bound']['north_east']['longitude'],
            );

            if (isset($config['rectangle']['bound']['south_west']['no_wrap'])
                && isset($config['rectangle']['bound']['north_east']['no_wrap'])) {
                $bound = array_merge(
                    $bound,
                    array(
                        $config['rectangle']['bound']['south_west']['no_wrap'],
                        $config['rectangle']['bound']['north_east']['no_wrap'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setBound', $bound);
        }

        if (isset($config['rectangle']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['rectangle']['options']));
        }
    }

    /**
     * Loads circle configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadCircle(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.circle.builder');

        if (isset($config['circle']['class'])) {
            $builderDefinition->replaceArgument(0, $config['circle']['class']);
        }

        if (isset($config['circle']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.circle')
                ->setClass($config['circle']['helper_class']);
        }

        if (isset($config['circle']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['circle']['prefix_javascript_variable'])
            );
        }

        if (isset($config['circle']['center']['latitude']) && isset($config['circle']['center']['longitude'])) {
            $center = array($config['circle']['center']['latitude'], $config['circle']['center']['longitude']);

            if (isset($config['circle']['center']['no_wrap'])) {
                $center[] = $config['circle']['center']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setCenter', $center);
        }

        if (isset($config['circle']['radius'])) {
            $builderDefinition->addMethodCall('setRadius', array($config['circle']['radius']));
        }

        if (isset($config['circle']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['circle']['options']));
        }
    }

    /**
     * Loads ground overlay configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGroundOverlay(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.ground_overlay.builder');

        if (isset($config['ground_overlay']['class'])) {
            $builderDefinition->replaceArgument(0, $config['ground_overlay']['class']);
        }

        if (isset($config['ground_overlay']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.ground_overlay')
                ->setClass($config['ground_overlay']['helper_class']);
        }

        if (isset($config['ground_overlay']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['ground_overlay']['prefix_javascript_variable'])
            );
        }

        if (isset($config['ground_overlay']['url'])) {
            $builderDefinition->addMethodCall('setUrl', array($config['ground_overlay']['url']));
        }

        if (isset($config['ground_overlay']['bound']['south_west']['latitude'])
            && isset($config['ground_overlay']['bound']['south_west']['longitude'])
            && isset($config['ground_overlay']['bound']['north_east']['latitude'])
            && isset($config['ground_overlay']['bound']['north_east']['longitude'])) {
            $bound = array(
                $config['ground_overlay']['bound']['south_west']['latitude'],
                $config['ground_overlay']['bound']['south_west']['longitude'],
                $config['ground_overlay']['bound']['north_east']['latitude'],
                $config['ground_overlay']['bound']['north_east']['longitude']
            );

            if (isset($config['ground_overlay']['bound']['south_west']['no_wrap'])
                && isset($config['ground_overlay']['bound']['north_east']['no_wrap'])) {
                $bound = array_merge(
                    $bound,
                    array(
                        $config['ground_overlay']['bound']['south_west']['no_wrap'],
                        $config['ground_overlay']['bound']['north_east']['no_wrap'],
                    )
                );
            }

            $builderDefinition->addMethodCall('setBound', $bound);
        }

        if (isset($config['ground_overlay']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['ground_overlay']['options']));
        }
    }

    /**
     * Loads KML layer configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadKMLLayer(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.kml_layer.builder');

        if (isset($config['kml_layer']['class'])) {
            $builderDefinition->setArguments(array($config['kml_layer']['class']));
        }

        if (isset($config['kml_layer']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.kml_layer')
                ->setClass($config['kml_layer']['helper_class']);
        }

        if (isset($config['kml_layer']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['kml_layer']['prefix_javascript_variable'])
            );
        }

        if (isset($config['kml_layer']['url'])) {
            $builderDefinition->addMethodCall('setUrl', array($config['kml_layer']['url']));
        }

        if (isset($config['kml_layer']['options'])) {
            $builderDefinition->addMethodCall('setOptions', array($config['kml_layer']['options']));
        }
    }

    /**
     * Loads event manager configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEventManager(array $config, ContainerBuilder $container)
    {
        if (isset($config['event_manager']['class'])) {
            $container
                ->getDefinition('ivory_google_map.event_manager.builder')
                ->setArguments(array($config['event_manager']['class']));
        }

        if (isset($config['event_manager']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.event_manager')
                ->setClass($config['event_manager']['helper_class']);
        }
    }

    /**
     * Loads event configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEvent(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.event.builder');

        if (isset($config['event']['class'])) {
            $builderDefinition->setArguments(array($config['event']['class']));
        }

        if (isset($config['event']['prefix_javascript_variable'])) {
            $builderDefinition->addMethodCall(
                'setPrefixJavascriptVariable',
                array($config['event']['prefix_javascript_variable'])
            );
        }
    }

    /**
     * Loads encoding configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEncoding(array $config, ContainerBuilder $container)
    {
        if (isset($config['encoding']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.encoding')
                ->setClass($config['encoding']['helper_class']);
        }
    }

    /**
     * Loads geocoder provider configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGeocoder(array $config, ContainerBuilder $container)
    {
        $providerDefinition = $container->getDefinition('ivory_google_map.geocoder.provider');

        if (isset($config['geocoder']['class'])) {
            $container
                ->getDefinition('ivory_google_map.geocoder')
                ->setClass($config['geocoder']['class']);
        }

        if (isset($config['geocoder']['adapter'])) {
            $container
                ->getDefinition('ivory_google_map.geocoder.adapter')
                ->setClass($config['geocoder']['adapter']);
        }

        if (isset($config['geocoder']['provider']['class'])) {
            $providerDefinition->setClass($config['geocoder']['provider']['class']);
        }

        if (isset($config['geocoder']['provider']['api_key'])) {
            $providerDefinition->addArgument($config['geocoder']['provider']['api_key']);
        }

        if (isset($config['geocoder']['provider']['locale'])) {
            $providerDefinition->addArgument($config['geocoder']['provider']['locale']);
        }
    }

    /**
     * Loads geocoder fake request configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGeocoderFakeRequest(array $config, ContainerBuilder $container)
    {
        if (isset($config['geocoder']['fake_ip'])) {
            $fakeRequestDefinition = new Definition(
                'Ivory\GoogleMapBundle\EventListener\FakeRequestListener',
                array($config['geocoder']['fake_ip'])
            );

            $fakeRequestDefinition->addTag(
                'kernel.event_listener',
                array('event' => 'kernel.request', 'method' => 'onKernelRequest')
            );

            $container->setDefinition('ivory_google_map.geocoder.event_listener.fake_request', $fakeRequestDefinition);
        }
    }

    /**
     * Loads geocoder request configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGeocoderRequest(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.geocoder_request.builder');

        if (isset($config['geocoder_request']['class'])) {
            $builderDefinition->replaceArgument(0, $config['geocoder_request']['class']);
        }

        if (isset($config['geocoder_request']['address'])) {
            $builderDefinition->addMethodCall('setAddress', array($config['geocoder_request']['address']));
        }

        if (isset($config['geocoder_request']['coordinate']['latitude'])
            && isset($config['geocoder_request']['coordinate']['longitude'])) {
            $coordinate = array(
                $config['geocoder_request']['coordinate']['latitude'],
                $config['geocoder_request']['coordinate']['longitude'],
            );

            if (isset($config['geocoder_request']['coordinate']['no_wrap'])) {
                $coordinate[] = $config['geocoder_request']['coordinate']['no_wrap'];
            }

            $builderDefinition->addMethodCall('setCoordinate', $coordinate);
        }

        if (isset($config['geocoder_request']['bound']['south_west']['latitude'])
            && isset($config['geocoder_request']['bound']['south_west']['longitude'])
            && isset($config['geocoder_request']['bound']['north_east']['latitude'])
            && isset($config['geocoder_request']['bound']['north_east']['longitude'])) {
            $bound = array(
                $config['geocoder_request']['bound']['south_west']['latitude'],
                $config['geocoder_request']['bound']['south_west']['longitude'],
                $config['geocoder_request']['bound']['north_east']['latitude'],
                $config['geocoder_request']['bound']['north_east']['longitude'],
            );

            if (isset($config['geocoder_request']['bound']['south_west']['no_wrap'])
                && isset($config['geocoder_request']['bound']['north_east']['no_wrap'])) {
                $bound = array_merge(
                    $bound,
                    array(
                        $config['geocoder_request']['bound']['south_west']['no_wrap'],
                        $config['geocoder_request']['bound']['north_east']['no_wrap']
                    )
                );
            }

            $builderDefinition->addMethodCall('setBound', $bound);
        }

        if (isset($config['geocoder_request']['region'])) {
            $builderDefinition->addMethodCall('setRegion', array($config['geocoder_request']['region']));
        }

        if (isset($config['geocoder_request']['language'])) {
            $builderDefinition->addMethodCall('setLanguage', array($config['geocoder_request']['language']));
        }

        if (isset($config['geocoder_request']['sensor'])) {
            $builderDefinition->addMethodCall('setSensor', array($config['geocoder_request']['sensor']));
        }
    }

    /**
     * Loads directions configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDirections(array $config, ContainerBuilder $container)
    {
        $directionsDefinition = $container->getDefinition('ivory_google_map.directions');

        if (isset($config['directions']['class'])) {
            $directionsDefinition->setClass($config['directions']['class']);
        }

        if (isset($config['directions']['url'])) {
            $directionsDefinition->addMethodCall('setUrl', array($config['directions']['url']));
        }

        if (isset($config['directions']['https'])) {
            $directionsDefinition->addMethodCall('setHttps', array($config['directions']['https']));
        }

        if (isset($config['directions']['format'])) {
            $directionsDefinition->addMethodCall('setFormat', array($config['directions']['format']));
        }
    }

    /**
     * Loads directions request configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDirectionsRequest(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.directions_request.builder');

        if (isset($config['directions_request']['class'])) {
            $builderDefinition->replaceArgument(0, $config['directions_request']['class']);
        }

        if (isset($config['directions_request']['avoid_highways'])) {
            $builderDefinition->addMethodCall(
                'setAvoidHighways',
                array($config['directions_request']['avoid_highways'])
            );
        }

        if (isset($config['directions_request']['avoid_tolls'])) {
            $builderDefinition->addMethodCall('setAvoidTolls', array($config['directions_request']['avoid_tolls']));
        }

        if (isset($config['directions_request']['optimize_waypoints'])) {
            $builderDefinition->addMethodCall(
                'setOptimizeWaypoints',
                array($config['directions_request']['optimize_waypoints'])
            );
        }

        if (isset($config['directions_request']['provide_route_alternatives'])) {
            $builderDefinition->addMethodCall(
                'setProvideRouteAlternatives',
                array($config['directions_request']['provide_route_alternatives'])
            );
        }

        if (isset($config['directions_request']['region'])) {
            $builderDefinition->addMethodCall('setRegion', array($config['directions_request']['region']));
        }

        if (isset($config['directions_request']['language'])) {
            $builderDefinition->addMethodCall('setLanguage', array($config['directions_request']['language']));
        }

        if (isset($config['directions_request']['travel_mode'])) {
            $builderDefinition->addMethodCall('setTravelMode', array($config['directions_request']['travel_mode']));
        }

        if (isset($config['directions_request']['unit_system'])) {
            $builderDefinition->addMethodCall('setUnitSystem', array($config['directions_request']['unit_system']));
        }

        if (isset($config['directions_request']['sensor'])) {
            $builderDefinition->addMethodCall('setSensor', array($config['directions_request']['sensor']));
        }
    }

    /**
     * Loads distance matrix configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDistanceMatrix(array $config, ContainerBuilder $container)
    {
        $distanceMatrixDefinition = $container->getDefinition('ivory_google_map.distance_matrix');

        if (isset($config['distance_matrix']['class'])) {
            $distanceMatrixDefinition->setClass($config['distance_matrix']['class']);
        }

        if (isset($config['distance_matrix']['url'])) {
            $distanceMatrixDefinition->addMethodCall('setUrl', array($config['distance_matrix']['url']));
        }

        if (isset($config['distance_matrix']['https'])) {
            $distanceMatrixDefinition->addMethodCall('setHttps', array($config['distance_matrix']['https']));
        }

        if (isset($config['distance_matrix']['format'])) {
            $distanceMatrixDefinition->addMethodCall('setFormat', array($config['distance_matrix']['format']));
        }
    }

    /**
     * Loads distance matrix request configuration.
     *
     * @param array                                                   $config    The processed configuration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDistanceMatrixRequest(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.distance_matrix_request.builder');

        if (isset($config['distance_matrix_request']['class'])) {
            $builderDefinition->replaceArgument(0, $config['distance_matrix_request']['class']);
        }

        if (isset($config['distance_matrix_request']['avoid_highways'])) {
            $builderDefinition->addMethodCall(
                'setAvoidHighways',
                array($config['distance_matrix_request']['avoid_highways'])
            );
        }

        if (isset($config['distance_matrix_request']['avoid_tolls'])) {
            $builderDefinition->addMethodCall('setAvoidTolls', array($config['distance_matrix_request']['avoid_tolls']));
        }

        if (isset($config['distance_matrix_request']['region'])) {
            $builderDefinition->addMethodCall('setRegion', array($config['distance_matrix_request']['region']));
        }

        if (isset($config['distance_matrix_request']['language'])) {
            $builderDefinition->addMethodCall('setLanguage', array($config['distance_matrix_request']['language']));
        }

        if (isset($config['distance_matrix_request']['travel_mode'])) {
            $builderDefinition->addMethodCall('setTravelMode', array($config['distance_matrix_request']['travel_mode']));
        }

        if (isset($config['distance_matrix_request']['unit_system'])) {
            $builderDefinition->addMethodCall('setUnitSystem', array($config['distance_matrix_request']['unit_system']));
        }

        if (isset($config['distance_matrix_request']['sensor'])) {
            $builderDefinition->addMethodCall('setSensor', array($config['distance_matrix_request']['sensor']));
        }
    }
}
