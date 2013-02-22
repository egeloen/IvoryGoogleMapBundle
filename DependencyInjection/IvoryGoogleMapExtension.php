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

use Symfony\Component\Config\Definition\Processor,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition,
    Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
    Symfony\Component\HttpKernel\DependencyInjection\Extension;

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
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $resources = array(
            'services/base.xml',
            'services/controls.xml',
            'services/events.xml',
            'services/layers.xml',
            'services.xml',
            'twig.xml',
        );

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        foreach ($resources as $resource) {
            $loader->load($resource);
        }

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
        $this->loadGeocoderRequest($config, $container);
        $this->loadDirections($config, $container);
        $this->loadDirectionsRequest($config, $container);
    }

    /**
     * Loads map configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMap(array $config, ContainerBuilder $container)
    {
        if (isset($config['map']['class'])) {
            $container
                ->getDefinition('ivory_google_map.map')
                ->setClass($config['map']['class']);
        }

        if (isset($config['map']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.map')
                ->setClass($config['map']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.map.prefix_javascript_variable',
            $config['map']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.map.html_container', $config['map']['html_container']);
        $container->setParameter('ivory_google_map.map.async', $config['map']['async']);
        $container->setParameter('ivory_google_map.map.auto_zoom', $config['map']['auto_zoom']);
        $container->setParameter('ivory_google_map.map.center.longitude', $config['map']['center']['longitude']);
        $container->setParameter('ivory_google_map.map.center.latitude', $config['map']['center']['latitude']);
        $container->setParameter('ivory_google_map.map.center.no_wrap', $config['map']['center']['no_wrap']);

        $container->setParameter(
            'ivory_google_map.map.bound.south_west.longitude',
            $config['map']['bound']['south_west']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.map.bound.south_west.latitude',
            $config['map']['bound']['south_west']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.map.bound.south_west.no_wrap',
            $config['map']['bound']['south_west']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.map.bound.north_east.longitude',
            $config['map']['bound']['north_east']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.map.bound.north_east.latitude',
            $config['map']['bound']['north_east']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.map.bound.north_east.no_wrap',
            $config['map']['bound']['north_east']['no_wrap']
        );

        $container->setParameter('ivory_google_map.map.type', $config['map']['type']);
        $container->setParameter('ivory_google_map.map.zoom', $config['map']['zoom']);
        $container->setParameter('ivory_google_map.map.width', $config['map']['width']);
        $container->setParameter('ivory_google_map.map.height', $config['map']['height']);
        $container->setParameter('ivory_google_map.map.map_options', $config['map']['map_options']);
        $container->setParameter('ivory_google_map.map.stylesheet_options', $config['map']['stylesheet_options']);
        $container->setParameter('ivory_google_map.map.language', $config['map']['language']);
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
            $builderDefinition->setArguments(array_replace(
                $builderDefinition->getArguments(),
                array($config['coordinate']['class'])
            ));
        }

        if (isset($config['coordinate']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.coordinate')
                ->setClass($config['coordinate']['helper_class']);
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
            $builderDefinition->setArguments(array_replace(
                $builderDefinition->getArguments(),
                array($config['bound']['class'])
            ));
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
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarker(array $config, ContainerBuilder $container)
    {
        if (isset($config['marker']['class'])) {
            $container
                ->getDefinition('ivory_google_map.marker')
                ->setClass($config['marker']['class']);
        }

        if (isset($config['marker']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker')
                ->setClass($config['marker']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.marker.prefix_javascript_variable',
            $config['marker']['prefix_javascript_variable']
        );

        $container->setParameter(
            'ivory_google_map.marker.position.latitude',
            $config['marker']['position']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.marker.position.longitude',
            $config['marker']['position']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.marker.position.no_wrap',
            $config['marker']['position']['no_wrap']
        );

        $container->setParameter('ivory_google_map.marker.animation', $config['marker']['animation']);
        $container->setParameter('ivory_google_map.marker.options', $config['marker']['options']);
    }

    /**
     * Loads marker image configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarkerImage(array $config, ContainerBuilder $container)
    {
        if (isset($config['marker_image']['class'])) {
            $container
                ->getDefinition('ivory_google_map.marker_image')
                ->setClass($config['marker_image']['class']);
        }

        if (isset($config['marker_image']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker_image')
                ->setClass($config['marker_image']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.marker_image.prefix_javascript_variable',
            $config['marker_image']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.marker_image.url', $config['marker_image']['url']);
        $container->setParameter('ivory_google_map.marker_image.anchor.x', $config['marker_image']['anchor']['x']);
        $container->setParameter('ivory_google_map.marker_image.anchor.y', $config['marker_image']['anchor']['y']);
        $container->setParameter('ivory_google_map.marker_image.origin.x', $config['marker_image']['origin']['x']);
        $container->setParameter('ivory_google_map.marker_image.origin.y', $config['marker_image']['origin']['y']);

        $container->setParameter(
            'ivory_google_map.marker_image.scaled_size.width',
            $config['marker_image']['scaled_size']['width']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.scaled_size.height',
            $config['marker_image']['scaled_size']['height']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.scaled_size.width_unit',
            $config['marker_image']['scaled_size']['width_unit']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.scaled_size.height_unit',
            $config['marker_image']['scaled_size']['height_unit']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.size.width',
            $config['marker_image']['size']['width']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.size.height',
            $config['marker_image']['size']['height']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.size.width_unit',
            $config['marker_image']['size']['width_unit']
        );

        $container->setParameter(
            'ivory_google_map.marker_image.size.height_unit',
            $config['marker_image']['size']['height_unit']
        );
    }

    /**
     * Loads marker shape configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadMarkerShape(array $config, ContainerBuilder $container)
    {
        if (isset($config['marker_shape']['class'])) {
            $container
                ->getDefinition('ivory_google_map.marker_shape')
                ->setClass($config['marker_shape']['class']);
        }

        if (isset($config['marker_shape']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.marker_shape')
                ->setClass($config['marker_shape']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.marker_shape.prefix_javascript_variable',
            $config['marker_shape']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.marker_shape.type', $config['marker_shape']['type']);
        $container->setParameter('ivory_google_map.marker_shape.coordinates', $config['marker_shape']['coordinates']);
    }

    /**
     * Loads info window configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadInfoWindow(array $config, ContainerBuilder $container)
    {
        if (isset($config['info_window']['class'])) {
            $container
                ->getDefinition('ivory_google_map.info_window')
                ->setClass($config['info_window']['class']);
        }

        if (isset($config['info_window']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.info_window')
                ->setClass($config['info_window']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.info_window.prefix_javascript_variable',
            $config['info_window']['prefix_javascript_variable']
        );

        $container->setParameter(
            'ivory_google_map.info_window.position.latitude',
            $config['info_window']['position']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.info_window.position.longitude',
            $config['info_window']['position']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.info_window.position.no_wrap',
            $config['info_window']['position']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.info_window.pixel_offset.width',
            $config['info_window']['pixel_offset']['width']
        );

        $container->setParameter(
            'ivory_google_map.info_window.pixel_offset.height',
            $config['info_window']['pixel_offset']['height']
        );

        $container->setParameter(
            'ivory_google_map.info_window.pixel_offset.width_unit',
            $config['info_window']['pixel_offset']['width_unit']
        );

        $container->setParameter(
            'ivory_google_map.info_window.pixel_offset.height_unit',
            $config['info_window']['pixel_offset']['height_unit']
        );

        $container->setParameter('ivory_google_map.info_window.content', $config['info_window']['content']);
        $container->setParameter('ivory_google_map.info_window.open', $config['info_window']['open']);
        $container->setParameter('ivory_google_map.info_window.auto_open', $config['info_window']['auto_open']);
        $container->setParameter('ivory_google_map.info_window.open_event', $config['info_window']['open_event']);
        $container->setParameter('ivory_google_map.info_window.auto_close', $config['info_window']['auto_close']);
        $container->setParameter('ivory_google_map.info_window.options', $config['info_window']['options']);
    }

    /**
     * Loads polyline configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPolyline(array $config, ContainerBuilder $container)
    {
        if (isset($config['polyline']['class'])) {
            $container
                ->getDefinition('ivory_google_map.polyline')
                ->setClass($config['polyline']['class']);
        }

        if (isset($config['polyline']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.polyline')
                ->setClass($config['polyline']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.polyline.prefix_javascript_variable',
            $config['polyline']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.polyline.options', $config['polyline']['options']);
    }

    /**
     * Loads encoded polyline configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEncodedPolyline(array $config, ContainerBuilder $container)
    {
        if (isset($config['encoded_polyline']['class'])) {
            $container
                ->getDefinition('ivory_google_map.encoded_polyline')
                ->setClass($config['encoded_polyline']['class']);
        }

        if (isset($config['encoded_polyline']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.encoded_polyline')
                ->setClass($config['encoded_polyline']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.encoded_polyline.prefix_javascript_variable',
            $config['encoded_polyline']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.encoded_polyline.options', $config['encoded_polyline']['options']);
    }

    /**
     * Loads polygon configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadPolygon(array $config, ContainerBuilder $container)
    {
        if (isset($config['polygon']['class'])) {
            $container
                ->getDefinition('ivory_google_map.polygon')
                ->setClass($config['polygon']['class']);
        }

        if (isset($config['polygon']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.polygon')
                ->setClass($config['polygon']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.polygon.prefix_javascript_variable',
            $config['polygon']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.polygon.options', $config['polygon']['options']);
    }

    /**
     * Loads rectangle configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadRectangle(array $config, ContainerBuilder $container)
    {
        if (isset($config['rectangle']['class'])) {
            $container
                ->getDefinition('ivory_google_map.rectangle')
                ->setClass($config['rectangle']['class']);
        }

        if (isset($config['rectangle']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.rectangle')
                ->setClass($config['rectangle']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.rectangle.prefix_javascript_variable',
            $config['rectangle']['prefix_javascript_variable']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.south_west.latitude',
            $config['rectangle']['bound']['south_west']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.south_west.longitude',
            $config['rectangle']['bound']['south_west']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.south_west.no_wrap',
            $config['rectangle']['bound']['south_west']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.north_east.latitude',
            $config['rectangle']['bound']['north_east']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.north_east.longitude',
            $config['rectangle']['bound']['north_east']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.rectangle.bound.north_east.no_wrap',
            $config['rectangle']['bound']['north_east']['no_wrap']
        );

        $container->setParameter('ivory_google_map.rectangle.options', $config['rectangle']['options']);
    }

    /**
     * Loads circle configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadCircle(array $config, ContainerBuilder $container)
    {
        if (isset($config['circle']['class'])) {
            $container
                ->getDefinition('ivory_google_map.circle')
                ->setClass($config['circle']['class']);
        }

        if (isset($config['circle']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.circle')
                ->setClass($config['circle']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.circle.prefix_javascript_variable',
            $config['circle']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.circle.center.longitude', $config['circle']['center']['longitude']);
        $container->setParameter('ivory_google_map.circle.center.latitude', $config['circle']['center']['latitude']);
        $container->setParameter('ivory_google_map.circle.center.no_wrap', $config['circle']['center']['no_wrap']);
        $container->setParameter('ivory_google_map.circle.radius', $config['circle']['radius']);
        $container->setParameter('ivory_google_map.circle.options', $config['circle']['options']);
    }

    /**
     * Loads ground overlay configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGroundOverlay(array $config, ContainerBuilder $container)
    {
        if (isset($config['ground_overlay']['class'])) {
            $container
                ->getDefinition('ivory_google_map.ground_overlay')
                ->setClass($config['ground_overlay']['class']);
        }

        if (isset($config['ground_overlay']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.ground_overlay')
                ->setClass($config['ground_overlay']['helper_class']);
        }

        $container->setParameter(
            'ivory_google_map.ground_overlay.prefix_javascript_variable',
            $config['ground_overlay']['prefix_javascript_variable']
        );

        $container->setParameter('ivory_google_map.ground_overlay.url', $config['ground_overlay']['url']);

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.south_west.latitude',
            $config['ground_overlay']['bound']['south_west']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.south_west.longitude',
            $config['ground_overlay']['bound']['south_west']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.south_west.no_wrap',
            $config['ground_overlay']['bound']['south_west']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.north_east.latitude',
            $config['ground_overlay']['bound']['north_east']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.north_east.longitude',
            $config['ground_overlay']['bound']['north_east']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.ground_overlay.bound.north_east.no_wrap',
            $config['ground_overlay']['bound']['north_east']['no_wrap']
        );

        $container->setParameter('ivory_google_map.ground_overlay.options', $config['ground_overlay']['options']);
    }

    /**
     * Loads KML layer configuration.
     *
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadEvent(array $config, ContainerBuilder $container)
    {
        $builderDefinition = $container->getDefinition('ivory_google_map.event.builder');

        if (isset($config['event']['class'])) {
            $builderDefinition->setArguments(array($config['event']['class']));
        }

        if (isset($config['event']['helper_class'])) {
            $container
                ->getDefinition('ivory_google_map.helper.event')
                ->setClass($config['event']['helper_class']);
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
     * @param array                                                   $config    The processed condiguration.
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
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGeocoder(array $config, ContainerBuilder $container)
    {
        if ($config['geocoder']['fake_ip'] !== null) {
            $definition = new Definition(
                $container->getParameter('ivory_google_map.geocoder.event_listener.fake_request.class'),
                array($config['geocoder']['fake_ip'])
            );

            $definition->addTag('kernel.event_listener', array(
                'event'  => 'kernel.request',
                'method' => 'onKernelRequest',
            ));

            $container->setDefinition('ivory_google_map.geocoder.event_listener.fake_request', $definition);
        }

        if ($config['geocoder']['class'] !== null) {
            $container->setParameter('ivory_google_map.geocoder.class', $config['geocoder']['class']);
        }

        if ($config['geocoder']['adapter'] !== null) {
            $container->setParameter('ivory_google_map.geocoder.adapter.class', $config['geocoder']['adapter']);
        }

        if ($config['geocoder']['provider']['class'] !== null) {
            $container->setParameter('ivory_google_map.geocoder.provider.class', $config['geocoder']['provider']['class']);
        }

        if ($config['geocoder']['provider']['api_key'] !== null) {
            $container
                ->getDefinition('ivory_google_map.geocoder.provider')
                ->replaceArgument(1, $config['geocoder']['provider']['api_key']);
        }

        if ($config['geocoder']['provider']['locale'] !== null) {
            $container
                ->getDefinition('ivory_google_map.geocoder.provider')
                ->replaceArgument(
                    $config['geocoder']['provider']['api_key'] !== null ? 2 : 1,
                    $config['geocoder']['provider']['locale']
                );
        }
    }

    /**
     * Loads geocoder request configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadGeocoderRequest(array $config, ContainerBuilder $container)
    {
        if (isset($config['geocoder_request']['class'])) {
            $container
                ->getDefinition('ivory_google_map.geocoder_request')
                ->setClass($config['geocoder_request']['class']);
        }

        $container->setParameter('ivory_google_map.geocoder_request.address', $config['geocoder_request']['address']);

        $container->setParameter(
            'ivory_google_map.geocoder_request.coordinate.latitude',
            $config['geocoder_request']['coordinate']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.coordinate.longitude',
            $config['geocoder_request']['coordinate']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.coordinate.no_wrap',
            $config['geocoder_request']['coordinate']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.south_west.latitude',
            $config['geocoder_request']['bound']['south_west']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.south_west.longitude',
            $config['geocoder_request']['bound']['south_west']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.south_west.no_wrap',
            $config['geocoder_request']['bound']['south_west']['no_wrap']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.north_east.latitude',
            $config['geocoder_request']['bound']['north_east']['latitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.north_east.longitude',
            $config['geocoder_request']['bound']['north_east']['longitude']
        );

        $container->setParameter(
            'ivory_google_map.geocoder_request.bound.north_east.no_wrap',
            $config['geocoder_request']['bound']['north_east']['no_wrap']
        );

        $container->setParameter('ivory_google_map.geocoder_request.region', $config['geocoder_request']['region']);
        $container->setParameter('ivory_google_map.geocoder_request.language', $config['geocoder_request']['language']);
        $container->setParameter('ivory_google_map.geocoder_request.sensor', $config['geocoder_request']['sensor']);
    }

    /**
     * Loads directions configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDirections(array $config, ContainerBuilder $container)
    {
        if (isset($config['directions']['class'])) {
            $container
                ->getDefinition('ivory_google_map.directions')
                ->setClass($config['directions']['class']);
        }

        $container->setParameter('ivory_google_map.directions.url', $config['directions']['url']);
        $container->setParameter('ivory_google_map.directions.https', $config['directions']['https']);
        $container->setParameter('ivory_google_map.directions.format', $config['directions']['format']);
    }

    /**
     * Loads directions request configuration.
     *
     * @param array                                                   $config    The processed condiguration.
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container builder.
     */
    protected function loadDirectionsRequest(array $config, ContainerBuilder $container)
    {
        if (isset($config['directions_request']['class'])) {
            $container
                ->getDefinition('ivory_google_map.directions_request')
                ->setClass($config['directions_request']['class']);
        }

        $container->setParameter(
            'ivory_google_map.directions_request.avoid_highways',
            $config['directions_request']['avoid_highways']
        );

        $container->setParameter(
            'ivory_google_map.directions_request.avoid_tolls',
            $config['directions_request']['avoid_tolls']
        );

        $container->setParameter(
            'ivory_google_map.directions_request.optimize_waypoints',
            $config['directions_request']['optimize_waypoints']
        );

        $container->setParameter(
            'ivory_google_map.directions_request.provide_route_alternatives',
            $config['directions_request']['provide_route_alternatives']
        );

        $container->setParameter('ivory_google_map.directions_request.region', $config['directions_request']['region']);

        $container->setParameter(
            'ivory_google_map.directions_request.language',
            $config['directions_request']['language']
        );

        $container->setParameter(
            'ivory_google_map.directions_request.travel_mode',
            $config['directions_request']['travel_mode'] !== null ? strtoupper($config['directions_request']['travel_mode']) : null
        );

        $container->setParameter(
            'ivory_google_map.directions_request.unit_system',
            $config['directions_request']['unit_system'] !== null ? strtoupper($config['directions_request']['unit_system']) : null
        );

        $container->setParameter('ivory_google_map.directions_request.sensor', $config['directions_request']['sensor']);
    }
}
