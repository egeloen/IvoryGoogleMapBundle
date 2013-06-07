<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection;

use Ivory\GoogleMapBundle\DependencyInjection\IvoryGoogleMapExtension;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Abstract Ivory Google Map extension test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractIvoryGoogleMapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Symfony\Component\DependencyInjection\ContainerBuilder */
    protected $container;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->container->registerExtension(new IvoryGoogleMapExtension());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->container);
    }

    /**
     * Loads a configuration.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container     The container.
     * @param string                                                  $configuration The configuration.
     */
    abstract protected function loadConfiguration(ContainerBuilder $container, $configuration);

    public function testBoundServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $bound = $this->container->get('ivory_google_map.bound');

        $this->assertInstanceOf('Ivory\GoogleMap\Base\Bound', $bound);
        $this->assertSame('bound_', substr($bound->getJavascriptVariable(), 0, 6));
        $this->assertNull($bound->getSouthWest());
        $this->assertNull($bound->getNorthEast());
    }

    public function testBoundServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'bound');
        $this->container->compile();

        $bound = $this->container->get('ivory_google_map.bound');

        $this->assertSame('b', substr($bound->getJavascriptVariable(), 0, 1));

        $this->assertTrue($bound->hasCoordinates());

        $this->assertSame(-1.1, $bound->getSouthWest()->getLatitude());
        $this->assertSame(-2.1, $bound->getSouthWest()->getLongitude());
        $this->assertTrue($bound->getSouthWest()->isNoWrap());

        $this->assertSame(2.1, $bound->getNorthEast()->getLatitude());
        $this->assertSame(1.1, $bound->getNorthEast()->getLongitude());
        $this->assertFalse($bound->getNorthEast()->isNoWrap());
    }

    public function testBoundInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.bound'),
            $this->container->get('ivory_google_map.bound')
        );
    }

    public function testCoordinateServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $coordinate = $this->container->get('ivory_google_map.coordinate');

        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $coordinate);

        $this->assertSame('coordinate_', substr($coordinate->getJavascriptVariable(), 0, 11));
        $this->assertSame(0, $coordinate->getLatitude());
        $this->assertSame(0, $coordinate->getLongitude());
        $this->assertTrue($coordinate->isNoWrap());
    }

    public function testCoordinateServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'coordinate');
        $this->container->compile();

        $coordinate = $this->container->get('ivory_google_map.coordinate');

        $this->assertSame('foo', substr($coordinate->getJavascriptVariable(), 0, 3));
        $this->assertSame(1.1, $coordinate->getLatitude());
        $this->assertSame(-2.1, $coordinate->getLongitude());
        $this->assertFalse($coordinate->isNoWrap());
    }

    public function testCoordinateInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.coordinate'),
            $this->container->get('ivory_google_map.coordinate')
        );
    }

    public function testPointServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $point = $this->container->get('ivory_google_map.point');

        $this->assertInstanceOf('Ivory\GoogleMap\Base\Point', $point);
        $this->assertSame('point_', substr($point->getJavascriptVariable(), 0, 6));
        $this->assertSame(0, $point->getX());
        $this->assertSame(0, $point->getY());
    }

    public function testPointServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'point');
        $this->container->compile();

        $point = $this->container->get('ivory_google_map.point');

        $this->assertSame('foo', substr($point->getJavascriptVariable(), 0, 3));
        $this->assertSame(1.1, $point->getX());
        $this->assertSame(-2.1, $point->getY());
    }

    public function testPointInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.point'),
            $this->container->get('ivory_google_map.point')
        );
    }

    public function testSizeServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $size = $this->container->get('ivory_google_map.size');

        $this->assertInstanceOf('Ivory\GoogleMap\Base\Size', $size);

        $this->assertSame('size_', substr($size->getJavascriptVariable(), 0, 5));

        $this->assertSame(1, $size->getWidth());
        $this->assertSame(1, $size->getHeight());

        $this->assertNull($size->getWidthUnit());
        $this->assertNull($size->getHeightUnit());
    }

    public function testSizeServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'size');
        $this->container->compile();

        $size = $this->container->get('ivory_google_map.size');

        $this->assertSame('foo', substr($size->getJavascriptVariable(), 0, 3));

        $this->assertEquals($size->getWidth(), 100.1);
        $this->assertEquals($size->getHeight(), 200.2);

        $this->assertEquals($size->getWidthUnit(), 'px');
        $this->assertEquals($size->getHeightUnit(), 'pt');
    }

    public function testSizeInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.size'),
            $this->container->get('ivory_google_map.size')
        );
    }

    public function testMapTypeControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $mapTypeControl = $this->container->get('ivory_google_map.map_type_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\MapTypeControl', $mapTypeControl);
        $this->assertSame(array('roadmap', 'satellite'), $mapTypeControl->getMapTypeIds());
        $this->assertSame('top_right', $mapTypeControl->getControlPosition());
        $this->assertSame('default', $mapTypeControl->getMapTypeControlStyle());
    }

    public function testMapTypeControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'map_type_control');
        $this->container->compile();

        $mapTypeControl = $this->container->get('ivory_google_map.map_type_control');

        $this->assertEquals(array('hybrid', 'terrain'), $mapTypeControl->getMapTypeIds());
        $this->assertEquals('top_center', $mapTypeControl->getControlPosition());
        $this->assertEquals('horizontal_bar', $mapTypeControl->getMapTypeControlStyle());
    }

    public function testMapTypeControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.map_type_control'),
            $this->container->get('ivory_google_map.map_type_control')
        );
    }

    public function testOverviewMapControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $overviewMapControl = $this->container->get('ivory_google_map.overview_map_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\OverviewMapControl', $overviewMapControl);
        $this->assertFalse($overviewMapControl->isOpened());
    }

    public function testOverviewMapControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'overview_map_control');
        $this->container->compile();

        $overviewMapControl = $this->container->get('ivory_google_map.overview_map_control');

        $this->assertTrue($overviewMapControl->isOpened());
    }

    public function testOverviewMapControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.overview_map_control'),
            $this->container->get('ivory_google_map.overview_map_control')
        );
    }

    public function testPanControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $panControl = $this->container->get('ivory_google_map.pan_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\PanControl', $panControl);
        $this->assertSame('top_left', $panControl->getControlPosition());
    }

    public function testPanControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'pan_control');
        $this->container->compile();

        $panControl = $this->container->get('ivory_google_map.pan_control');

        $this->assertSame('top_center', $panControl->getControlPosition());
    }

    public function testPanControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.pan_control'),
            $this->container->get('ivory_google_map.pan_control')
        );
    }

    public function testRotateControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $rotateControl = $this->container->get('ivory_google_map.rotate_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\RotateControl', $rotateControl);
        $this->assertSame('top_left', $rotateControl->getControlPosition());
    }

    public function testRotateControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'rotate_control');
        $this->container->compile();

        $rotateControl = $this->container->get('ivory_google_map.rotate_control');

        $this->assertSame('top_center', $rotateControl->getControlPosition());
    }

    public function testRotateControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.rotate_control'),
            $this->container->get('ivory_google_map.rotate_control')
        );
    }

    public function testScaleControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $scaleControl = $this->container->get('ivory_google_map.scale_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\ScaleControl', $scaleControl);
        $this->assertSame('bottom_left', $scaleControl->getControlPosition());
        $this->assertSame('default', $scaleControl->getScaleControlStyle());
    }

    public function testScaleControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'scale_control');
        $this->container->compile();

        $scaleControl = $this->container->get('ivory_google_map.scale_control');

        $this->assertSame('top_center', $scaleControl->getControlPosition());
        $this->assertSame('default', $scaleControl->getScaleControlStyle());
    }

    public function testScaleControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.scale_control'),
            $this->container->get('ivory_google_map.scale_control')
        );
    }

    public function testStreetViewControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $streetViewControl = $this->container->get('ivory_google_map.street_view_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\StreetViewControl', $streetViewControl);
        $this->assertSame('top_left', $streetViewControl->getControlPosition());
    }

    public function testStreetViewControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'street_view_control');
        $this->container->compile();

        $streetViewControl = $this->container->get('ivory_google_map.street_view_control');

        $this->assertSame('top_center', $streetViewControl->getControlPosition());
    }

    public function testStreetViewControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.street_view_control'),
            $this->container->get('ivory_google_map.street_view_control')
        );
    }

    public function testZoomControlServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $zoomControl = $this->container->get('ivory_google_map.zoom_control');

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\ZoomControl', $zoomControl);
        $this->assertSame('top_left', $zoomControl->getControlPosition());
        $this->assertSame('default', $zoomControl->getZoomControlStyle());
    }

    public function testZoomControlServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'zoom_control');
        $this->container->compile();

        $zoomControl = $this->container->get('ivory_google_map.zoom_control');

        $this->assertSame('top_center', $zoomControl->getControlPosition());
        $this->assertSame('default', $zoomControl->getZoomControlStyle());
    }

    public function testZoomControlInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.zoom_control'),
            $this->container->get('ivory_google_map.zoom_control')
        );
    }

    public function testEventServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $event = $this->container->get('ivory_google_map.event');

        $this->assertInstanceOf('Ivory\GoogleMap\Events\Event', $event);
        $this->assertSame('event_', substr($event->getJavascriptVariable(), 0, 6));
    }

    public function testEventServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'event');
        $this->container->compile();

        $event = $this->container->get('ivory_google_map.event');

        $this->assertSame('e', substr($event->getJavascriptVariable(), 0, 1));
    }

    public function testEventInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.event'),
            $this->container->get('ivory_google_map.event')
        );
    }

    public function testEventManagerInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.event_manager'),
            $this->container->get('ivory_google_map.event_manager')
        );
    }

    public function testKmlLayerServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $kmlLayer = $this->container->get('ivory_google_map.kml_layer');

        $this->assertInstanceOf('Ivory\GoogleMap\Layers\KMLLayer', $kmlLayer);
        $this->assertSame('kml_layer_', substr($kmlLayer->getJavascriptVariable(), 0, 10));
        $this->assertNull($kmlLayer->getUrl());
        $this->assertEmpty($kmlLayer->getOptions());
    }

    public function testKmlLayerServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'kml_layer');
        $this->container->compile();

        $kmlLayer = $this->container->get('ivory_google_map.kml_layer');

        $this->assertSame('kl', substr($kmlLayer->getJavascriptVariable(), 0, 2));
        $this->assertSame('url', $kmlLayer->getUrl());
        $this->assertSame(array('option' => 'value'), $kmlLayer->getOptions());
    }

    public function testKmlLayerInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.kml_layer'),
            $this->container->get('ivory_google_map.kml_layer')
        );
    }

    public function testCircleServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $circle = $this->container->get('ivory_google_map.circle');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Circle', $circle);
        $this->assertEquals(substr($circle->getJavascriptVariable(), 0, 7), 'circle_');
        $this->assertEquals($circle->getCenter()->getLatitude(), 0);
        $this->assertEquals($circle->getCenter()->getLongitude(), 0);
        $this->assertTrue($circle->getCenter()->isNoWrap());
        $this->assertEquals($circle->getRadius(), 1);
    }

    public function testCircleServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'circle');
        $this->container->compile();

        $circle = $this->container->get('ivory_google_map.circle');

        $this->assertSame('c', substr($circle->getJavascriptVariable(), 0, 1));

        $this->assertSame(1.1, $circle->getCenter()->getLatitude());
        $this->assertSame(2.1, $circle->getCenter()->getLongitude());
        $this->assertFalse($circle->getCenter()->isNoWrap());

        $this->assertSame(10, $circle->getRadius());
        $this->assertSame(array('option' => 'value'), $circle->getOptions());
    }

    public function testCircleInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.circle'),
            $this->container->get('ivory_google_map.circle')
        );
    }

    public function testEncodedPolylineServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $encodedPolyline = $this->container->get('ivory_google_map.encoded_polyline');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\EncodedPolyline', $encodedPolyline);
        $this->assertSame('encoded_polyline_', substr($encodedPolyline->getJavascriptVariable(), 0, 17));
    }

    public function testEncodedPolylineServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'encoded_polyline');
        $this->container->compile();

        $encodedPolyline = $this->container->get('ivory_google_map.encoded_polyline');

        $this->assertSame('ep', substr($encodedPolyline->getJavascriptVariable(), 0, 2));
        $this->assertSame(array('option' => 'value'), $encodedPolyline->getOptions());
    }

    public function testEncodedPolylineInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.encoded_polyline'),
            $this->container->get('ivory_google_map.encoded_polyline')
        );
    }

    public function testGroundOverlayServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $groundOverlay = $this->container->get('ivory_google_map.ground_overlay');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\GroundOverlay', $groundOverlay);

        $this->assertSame('ground_overlay_', substr($groundOverlay->getJavascriptVariable(), 0, 15));
        $this->assertSame('', $groundOverlay->getUrl());

        $this->assertSame(1, $groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $groundOverlay->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1, $groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $groundOverlay->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());
    }

    public function testGroundOverlayServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'ground_overlay');
        $this->container->compile();

        $groundOverlay = $this->container->get('ivory_google_map.ground_overlay');

        $this->assertEquals('go', substr($groundOverlay->getJavascriptVariable(), 0, 2));
        $this->assertEquals('url', $groundOverlay->getUrl());

        $this->assertEquals(1.1, $groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertEquals(2.1, $groundOverlay->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($groundOverlay->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1.1, $groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-2.1, $groundOverlay->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());
    }

    public function testGroundOverlayInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.ground_overlay'),
            $this->container->get('ivory_google_map.ground_overlay')
        );
    }

    public function testInfoWindowServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $infoWindow = $this->container->get('ivory_google_map.info_window');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\InfoWindow', $infoWindow);
        $this->assertEquals('info_window_', substr($infoWindow->getJavascriptVariable(), 0, 12));

        $this->assertNull($infoWindow->getPosition());
        $this->assertSame($infoWindow->getContent(), '<p>Default content</p>');
        $this->assertFalse($infoWindow->hasPixelOffset());
        $this->assertNull($infoWindow->getPixelOffset());
        $this->assertFalse($infoWindow->isOpen());
        $this->assertTrue($infoWindow->isAutoOpen());
        $this->assertSame('click', $infoWindow->getOpenEvent());
        $this->assertFalse($infoWindow->isAutoClose());
        $this->assertEmpty($infoWindow->getOptions());
    }

    public function testInfoWindowServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'info_window');
        $this->container->compile();

        $infoWindow = $this->container->get('ivory_google_map.info_window');

        $this->assertSame('iw', substr($infoWindow->getJavascriptVariable(), 0, 2));

        $this->assertSame(1.1, $infoWindow->getPosition()->getLatitude());
        $this->assertSame(-2.1, $infoWindow->getPosition()->getLongitude());
        $this->assertFalse($infoWindow->getPosition()->isNoWrap());

        $this->assertSame('<div class="info_window"></div>', $infoWindow->getContent());

        $this->assertTrue($infoWindow->hasPixelOffset());
        $this->assertSame(1.1, $infoWindow->getPixelOffset()->getWidth());
        $this->assertSame(2.1, $infoWindow->getPixelOffset()->getHeight());
        $this->assertSame('px', $infoWindow->getPixelOffset()->getWidthUnit());
        $this->assertSame('pt', $infoWindow->getPixelOffset()->getHeightUnit());

        $this->assertTrue($infoWindow->isOpen());
        $this->assertFalse($infoWindow->isAutoOpen());
        $this->assertSame('dblclick', $infoWindow->getOpenEvent());
        $this->assertTrue($infoWindow->isAutoClose());

        $this->assertSame(array('option' => 'value'), $infoWindow->getOptions());
    }

    public function testInfoWindowInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.info_window'),
            $this->container->get('ivory_google_map.info_window')
        );
    }

    public function testMarkerImageServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $markerImage = $this->container->get('ivory_google_map.marker_image');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\MarkerImage', $markerImage);
        $this->assertSame('marker_image_', substr($markerImage->getJavascriptVariable(), 0, 13));
        $this->assertSame('//maps.gstatic.com/mapfiles/markers/marker.png', $markerImage->getUrl());

        $this->assertFalse($markerImage->hasAnchor());
        $this->assertNull($markerImage->getAnchor());

        $this->assertFalse($markerImage->hasOrigin());
        $this->assertNull($markerImage->getOrigin());

        $this->assertFalse($markerImage->hasScaledSize());
        $this->assertNull($markerImage->getScaledSize());

        $this->assertFalse($markerImage->hasSize());
        $this->assertNull($markerImage->getSize());
    }

    public function testMarkerImageServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'marker_image');
        $this->container->compile();

        $markerImage = $this->container->get('ivory_google_map.marker_image');

        $this->assertSame('mi', substr($markerImage->getJavascriptVariable(), 0, 2));
        $this->assertSame('url', $markerImage->getUrl());

        $this->assertTrue($markerImage->hasAnchor());
        $this->assertSame(1.1, $markerImage->getAnchor()->getX());
        $this->assertSame(2.1, $markerImage->getAnchor()->getY());

        $this->assertTrue($markerImage->hasOrigin());
        $this->assertSame(2.1, $markerImage->getOrigin()->getX());
        $this->assertSame(1.1, $markerImage->getOrigin()->getY());

        $this->assertTrue($markerImage->hasScaledSize());
        $this->assertSame(16, $markerImage->getScaledSize()->getWidth());
        $this->assertSame(19, $markerImage->getScaledSize()->getHeight());
        $this->assertSame("px", $markerImage->getScaledSize()->getWidthUnit());
        $this->assertSame("pt", $markerImage->getScaledSize()->getHeightUnit());

        $this->assertTrue($markerImage->hasSize());
        $this->assertSame(20, $markerImage->getSize()->getWidth());
        $this->assertSame(22, $markerImage->getSize()->getHeight());
        $this->assertSame("px", $markerImage->getSize()->getWidthUnit());
        $this->assertSame("pt", $markerImage->getSize()->getHeightUnit());
    }

    public function testMarkerImageInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.marker_image'),
            $this->container->get('ivory_google_map.marker_image')
        );
    }

    public function testMarkerServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $marker = $this->container->get('ivory_google_map.marker');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Marker', $marker);
        $this->assertSame('marker_', substr($marker->getJavascriptVariable(), 0, 7));

        $this->assertSame(0, $marker->getPosition()->getLatitude());
        $this->assertSame(0, $marker->getPosition()->getLongitude());
        $this->assertTrue($marker->getPosition()->isNoWrap());

        $this->assertFalse($marker->hasAnimation());
        $this->assertEmpty($marker->getOptions());
    }

    public function testMarkerServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'marker');
        $this->container->compile();

        $marker = $this->container->get('ivory_google_map.marker');

        $this->assertSame('m', substr($marker->getJavascriptVariable(), 0, 1));

        $this->assertSame(1.1, $marker->getPosition()->getLatitude());
        $this->assertSame(-2.1, $marker->getPosition()->getLongitude());
        $this->assertFalse($marker->getPosition()->isNoWrap());

        $this->assertTrue($marker->hasAnimation());
        $this->assertEquals(array('option' => 'value'), $marker->getOptions());
    }

    public function testMarkerInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.marker'),
            $this->container->get('ivory_google_map.marker')
        );
    }

    public function testMarkerShapeServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $markerShape = $this->container->get('ivory_google_map.marker_shape');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\MarkerShape', $markerShape);
        $this->assertSame('marker_shape_', substr($markerShape->getJavascriptVariable(), 0, 13));
        $this->assertSame('poly', $markerShape->getType());
        $this->assertTrue($markerShape->hasCoordinates());
        $this->assertSame(array(1, 1, 1, -1, -1, -1, -1, 1), $markerShape->getCoordinates());
    }

    public function testMarkerShapeServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'marker_shape');
        $this->container->compile();

        $markerShape = $this->container->get('ivory_google_map.marker_shape');

        $this->assertSame('ms', substr($markerShape->getJavascriptVariable(), 0, 2));
        $this->assertSame('rect', $markerShape->getType());
        $this->assertTrue($markerShape->hasCoordinates());
        $this->assertSame(array(-1.1, -2.1, 2.1, 1.1), $markerShape->getCoordinates());
    }

    public function testMarkerShapeInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.marker_shape'),
            $this->container->get('ivory_google_map.marker_shape')
        );
    }

    public function testPolygonServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $polygon = $this->container->get('ivory_google_map.polygon');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Polygon', $polygon);
        $this->assertSame('polygon_', substr($polygon->getJavascriptVariable(), 0, 8));
    }

    public function testPolygonServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'polygon');
        $this->container->compile();

        $polygon = $this->container->get('ivory_google_map.polygon');

        $this->assertSame('p', substr($polygon->getJavascriptVariable(), 0, 1));
        $this->assertSame(array('option' => 'value'), $polygon->getOptions());
    }

    public function testPolygonInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.polygon'),
            $this->container->get('ivory_google_map.polygon')
        );
    }

    public function testPolylineServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $polyline = $this->container->get('ivory_google_map.polyline');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Polyline', $polyline);
        $this->assertSame('polyline_', substr($polyline->getJavascriptVariable(), 0, 9));
    }

    public function testPolylineServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'polyline');
        $this->container->compile();

        $polyline = $this->container->get('ivory_google_map.polyline');

        $this->assertSame('p', substr($polyline->getJavascriptVariable(), 0, 1));
        $this->assertSame(array('option' => 'value'), $polyline->getOptions());
    }

    public function testPolylineInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.polyline'),
            $this->container->get('ivory_google_map.polyline')
        );
    }

    public function testRectangleServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $rectangle = $this->container->get('ivory_google_map.rectangle');

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Rectangle', $rectangle);
        $this->assertSame('rectangle_', substr($rectangle->getJavascriptVariable(), 0, 10));

        $this->assertSame(1, $rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1, $rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());
    }

    public function testRectangleServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'rectangle');
        $this->container->compile();

        $rectangle = $this->container->get('ivory_google_map.rectangle');

        $this->assertSame('r', substr($rectangle->getJavascriptVariable(), 0, 1));

        $this->assertSame(1.1, $rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(2.1, $rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1.1, $rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-2.1, $rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());
    }

    public function testRectangeInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.rectangle'),
            $this->container->get('ivory_google_map.rectangle')
        );
    }

    public function testMapServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $map = $this->container->get('ivory_google_map.map');

        $this->assertSame('map_', substr($map->getJavascriptVariable(), 0, 4));
        $this->assertSame('map_canvas', $map->getHtmlContainerId());
        $this->assertFalse($map->isAsync());
        $this->assertFalse($map->isAutoZoom());
        $this->assertFalse($map->hasLibraries());
        $this->assertSame('en', $map->getLanguage());

        $this->assertSame(0, $map->getCenter()->getLatitude());
        $this->assertSame(0, $map->getCenter()->getLongitude());
        $this->assertTrue($map->getCenter()->isNoWrap());

        $this->assertFalse($map->getBound()->hasCoordinates());
        $this->assertSame(array('mapTypeId' => 'roadmap', 'zoom' => 3), $map->getMapOptions());
        $this->assertSame(array('width' => '300px', 'height' => '300px'), $map->getStylesheetOptions());
    }

    public function testMapServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'map');
        $this->container->compile();

        $map = $this->container->get('ivory_google_map.map');

        $this->assertSame('foo', substr($map->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $map->getHtmlContainerId());
        $this->assertTrue($map->isAsync());
        $this->assertTrue($map->isAutoZoom());
        $this->assertFalse($map->hasLibraries());
        $this->assertSame('en', $map->getLanguage());

        $this->assertSame(1, $map->getCenter()->getLatitude());
        $this->assertSame(2, $map->getCenter()->getLongitude());
        $this->assertFalse($map->getCenter()->isNoWrap());

        $this->assertSame(1, $map->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $map->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($map->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $map->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $map->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($map->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(
            array('mapTypeId' => 'satellite', 'zoom' => 6, 'foo' => 'bar'),
            $map->getMapOptions()
        );

        $this->assertSame(
            array('width' => '400px', 'height' => '500px', 'bar' => 'foo'),
            $map->getStylesheetOptions()
        );
    }

    public function testMapServiceWithApiLibraries()
    {
        $this->loadConfiguration($this->container, 'api');
        $this->container->compile();

        $map = $this->container->get('ivory_google_map.map');

        $this->assertSame(array('places', 'geometry'), $map->getLibraries());
    }

    public function testMapInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.map'),
            $this->container->get('ivory_google_map.map')
        );
    }

    public function testFakeRequestListenerWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertFalse($this->container->has('ivory_google_map.geocoder.event_listener.fake_request'));
    }

    public function testFakeRequestListenerWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'fake_request');
        $this->container->compile();

        $fakeRequestListener = $this->container->get('ivory_google_map.geocoder.event_listener.fake_request');

        $this->assertSame('222.222.222.222', $fakeRequestListener->getFakeIp());
    }

    public function testGeocoderRequestServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.geocoder_request');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\GeocoderRequest', $request);
        $this->assertFalse($request->hasAddress());
        $this->assertFalse($request->hasCoordinate());
        $this->assertFalse($request->hasBound());
        $this->assertFalse($request->hasRegion());
        $this->assertFalse($request->hasLanguage());
        $this->assertFalse($request->hasSensor());
    }

    public function testGeocoderRequestServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'geocoder_request');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.geocoder_request');

        $this->assertTrue($request->hasAddress());
        $this->assertSame('address', $request->getAddress());

        $this->assertTrue($request->hasCoordinate());
        $this->assertSame(1.1, $request->getCoordinate()->getLatitude());
        $this->assertSame(2.1, $request->getCoordinate()->getLongitude());
        $this->assertTrue($request->getCoordinate()->isNoWrap());

        $this->assertTrue($request->hasBound());
        $this->assertSame(-3.2, $request->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1.4, $request->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($request->getBound()->getSouthWest()->isNoWrap());
        $this->assertSame(6.3, $request->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(2.3, $request->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($request->getBound()->getNorthEast()->isNoWrap());

        $this->assertTrue($request->hasRegion());
        $this->assertSame('es', $request->getRegion());

        $this->assertTrue($request->hasLanguage());
        $this->assertSame('pl', $request->getLanguage());

        $this->assertTrue($request->hasSensor());
    }

    public function testGeocoderRequestInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.geocoder_request'),
            $this->container->get('ivory_google_map.geocoder_request')
        );
    }

    public function testGeocoderServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $geocoder = $this->container->get('ivory_google_map.geocoder');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Geocoding\Geocoder', $geocoder);
    }

    public function testGeocoderServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'geocoder');
        $this->container->compile();

        $geocoder = $this->container->get('ivory_google_map.geocoder');

        $this->assertInstanceOf('Geocoder\Geocoder', $geocoder);
    }

    public function testGeocoderInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertSame(
            $this->container->get('ivory_google_map.geocoder'),
            $this->container->get('ivory_google_map.geocoder')
        );
    }

    public function testDirectionsRequestServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.directions_request');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\DirectionsRequest', $request);
        $this->assertFalse($request->hasAvoidHighWays());
        $this->assertFalse($request->hasAvoidTolls());
        $this->assertFalse($request->hasDestination());
        $this->assertFalse($request->hasOptimizeWaypoints());
        $this->assertFalse($request->hasOrigin());
        $this->assertFalse($request->hasProvideRouteAlternatives());
        $this->assertFalse($request->hasRegion());
        $this->assertFalse($request->hasLanguage());
        $this->assertFalse($request->hasTravelMode());
        $this->assertFalse($request->hasUnitSystem());
        $this->assertFalse($request->hasWaypoints());
        $this->assertFalse($request->hasSensor());
    }

    public function testDirectionsRequestServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'directions_request');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.directions_request');

        $this->assertTrue($request->hasAvoidHighways());
        $this->assertTrue($request->getAvoidHighways());

        $this->assertTrue($request->hasAvoidTolls());
        $this->assertTrue($request->getAvoidTolls());

        $this->assertTrue($request->hasOptimizeWaypoints());
        $this->assertTrue($request->getOptimizeWaypoints());

        $this->assertTrue($request->hasProvideRouteAlternatives());
        $this->assertTrue($request->getProvideRouteAlternatives());

        $this->assertTrue($request->hasRegion());
        $this->assertSame('es', $request->getRegion());

        $this->assertTrue($request->hasLanguage());
        $this->assertSame('en', $request->getLanguage());

        $this->assertTrue($request->hasTravelMode());
        $this->assertSame('WALKING', $request->getTravelMode());

        $this->assertTrue($request->hasUnitSystem());
        $this->assertSame('IMPERIAL', $request->getUnitSystem());

        $this->assertTrue($request->hasSensor());
    }

    public function testDirectionsRequestInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.directions_request'),
            $this->container->get('ivory_google_map.directions_request')
        );
    }

    public function testDirectionsServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $directions = $this->container->get('ivory_google_map.directions');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\Directions\Directions', $directions);
        $this->assertSame('http://maps.googleapis.com/maps/api/directions', $directions->getUrl());
        $this->assertFalse($directions->isHttps());
        $this->assertSame('json', $directions->getFormat());
    }

    public function testDirectionsServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'directions');
        $this->container->compile();

        $directions = $this->container->get('ivory_google_map.directions');

        $this->assertSame('https://directions', $directions->getUrl());
        $this->assertTrue($directions->isHttps());
        $this->assertSame('xml', $directions->getFormat());
    }

    public function testDirectionsInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertSame(
            $this->container->get('ivory_google_map.directions'),
            $this->container->get('ivory_google_map.directions')
        );
    }

    public function testDistanceMatrixRequestServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.distance_matrix_request');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest', $request);
        $this->assertFalse($request->hasAvoidHighWays());
        $this->assertFalse($request->hasAvoidTolls());
        $this->assertFalse($request->hasOrigins());
        $this->assertFalse($request->hasDestinations());
        $this->assertFalse($request->hasTravelMode());
        $this->assertFalse($request->hasUnitSystem());
        $this->assertFalse($request->hasRegion());
        $this->assertFalse($request->hasLanguage());
        $this->assertFalse($request->hasSensor());
    }

    public function testDistanceMatrixRequestServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_request');
        $this->container->compile();

        $request = $this->container->get('ivory_google_map.distance_matrix_request');

        $this->assertTrue($request->hasAvoidHighways());
        $this->assertTrue($request->getAvoidHighways());

        $this->assertTrue($request->hasAvoidTolls());
        $this->assertTrue($request->getAvoidTolls());

        $this->assertTrue($request->hasTravelMode());
        $this->assertSame(TravelMode::WALKING, $request->getTravelMode());

        $this->assertTrue($request->hasUnitSystem());
        $this->assertSame(UnitSystem::IMPERIAL, $request->getUnitSystem());

        $this->assertTrue($request->hasRegion());
        $this->assertSame('es', $request->getRegion());

        $this->assertTrue($request->hasLanguage());
        $this->assertSame('en', $request->getLanguage());

        $this->assertTrue($request->hasSensor());
    }

    public function testDistanceMatrixRequestInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertNotSame(
            $this->container->get('ivory_google_map.distance_matrix_request'),
            $this->container->get('ivory_google_map.distance_matrix_request')
        );
    }

    public function testDistanceMatrixServiceWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory_google_map.distance_matrix');

        $this->assertInstanceOf('Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix', $distanceMatrix);
        $this->assertSame('http://maps.googleapis.com/maps/api/distancematrix', $distanceMatrix->getUrl());
        $this->assertFalse($distanceMatrix->isHttps());
        $this->assertSame('json', $distanceMatrix->getFormat());
    }

    public function testDistanceMatrixServiceWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'distance_matrix');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory_google_map.distance_matrix');

        $this->assertSame('https://distance_matrix', $distanceMatrix->getUrl());
        $this->assertTrue($distanceMatrix->isHttps());
        $this->assertSame('xml', $distanceMatrix->getFormat());
    }

    public function testDistanceMatrixInstances()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertSame(
            $this->container->get('ivory_google_map.distance_matrix'),
            $this->container->get('ivory_google_map.distance_matrix')
        );
    }

    public function testHelpersWithoutConfiguration()
    {
        $this->loadConfiguration($this->container, 'empty');
        $this->container->compile();

        $this->assertInstanceOf(
            'Ivory\GoogleMap\Helper\MapHelper',
            $this->container->get('ivory_google_map.helper.map')
        );
    }

    public function testHelpersWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'helpers');
        $this->container->compile();

        $mapHelper = $this->container->get('ivory_google_map.helper.map');

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\ApiHelper',
            $mapHelper->getApiHelper()
        );

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\MapHelper', $mapHelper);

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\MapTypeIdHelper',
            $mapHelper->getMapTypeIdHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Base\CoordinateHelper',
            $mapHelper->getCoordinateHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Base\BoundHelper',
            $mapHelper->getBoundHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Base\PointHelper',
            $mapHelper->getPointHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Base\SizeHelper',
            $mapHelper->getSizeHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\ControlPositionHelper',
            $mapHelper->getMapTypeControlHelper()->getControlPositionHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\MapTypeControlHelper',
            $mapHelper->getMapTypeControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\MapTypeControlStyleHelper',
            $mapHelper->getMapTypeControlHelper()->getMapTypeControlStyleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\OverviewMapControlHelper',
            $mapHelper->getOverviewMapControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\PanControlHelper',
            $mapHelper->getPanControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\RotateControlHelper',
            $mapHelper->getRotateControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\ScaleControlHelper',
            $mapHelper->getScaleControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\ScaleControlStyleHelper',
            $mapHelper->getScaleControlHelper()->getScaleControlStyleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\StreetViewControlHelper',
            $mapHelper->getStreetViewControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\ZoomControlHelper',
            $mapHelper->getZoomControlHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Controls\ZoomControlStyleHelper',
            $mapHelper->getZoomControlHelper()->getZoomControlStyleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\AnimationHelper',
            $mapHelper->getMarkerHelper()->getAnimationHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\CircleHelper',
            $mapHelper->getCircleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\EncodedPolylineHelper',
            $mapHelper->getEncodedPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\GroundOverlayHelper',
            $mapHelper->getGroundOverlayHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\InfoWindowHelper',
            $mapHelper->getInfoWindowHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\MarkerHelper',
            $mapHelper->getMarkerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\MarkerImageHelper',
            $mapHelper->getMarkerImageHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\MarkerShapeHelper',
            $mapHelper->getMarkerShapeHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\PolygonHelper',
            $mapHelper->getPolygonHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\PolylineHelper',
            $mapHelper->getPolylineHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Overlays\RectangleHelper',
            $mapHelper->getRectangleHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Layers\KMLLayerHelper',
            $mapHelper->getKmlLayerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Events\EventManagerHelper',
            $mapHelper->getEventManagerHelper()
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Helper\Geometry\EncodingHelper',
            $mapHelper->getEncodedPolylineHelper()->getEncodingHelper()
        );
    }

    public function testClassesWithConfiguration()
    {
        $this->loadConfiguration($this->container, 'classes');
        $this->container->compile();

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Map',
            $this->container->get('ivory_google_map.map')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Base\Coordinate',
            $this->container->get('ivory_google_map.coordinate')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Base\Bound',
            $this->container->get('ivory_google_map.bound')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Base\Point',
            $this->container->get('ivory_google_map.point')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Base\Size',
            $this->container->get('ivory_google_map.size')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\MapTypeControl',
            $this->container->get('ivory_google_map.map_type_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\OverviewMapControl',
            $this->container->get('ivory_google_map.overview_map_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\PanControl',
            $this->container->get('ivory_google_map.pan_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\RotateControl',
            $this->container->get('ivory_google_map.rotate_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\ScaleControl',
            $this->container->get('ivory_google_map.scale_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\StreetViewControl',
            $this->container->get('ivory_google_map.street_view_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Controls\ZoomControl',
            $this->container->get('ivory_google_map.zoom_control')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\Circle',
            $this->container->get('ivory_google_map.circle')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\EncodedPolyline',
            $this->container->get('ivory_google_map.encoded_polyline')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\GroundOverlay',
            $this->container->get('ivory_google_map.ground_overlay')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\InfoWindow',
            $this->container->get('ivory_google_map.info_window')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\Marker',
            $this->container->get('ivory_google_map.marker')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\MarkerImage',
            $this->container->get('ivory_google_map.marker_image')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\MarkerShape',
            $this->container->get('ivory_google_map.marker_shape')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\Polygon',
            $this->container->get('ivory_google_map.polygon')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\Polyline',
            $this->container->get('ivory_google_map.polyline')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\Rectangle',
            $this->container->get('ivory_google_map.rectangle')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Layers\KMLLayer',
            $this->container->get('ivory_google_map.kml_layer')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Events\EventManager',
            $this->container->get('ivory_google_map.event_manager')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Events\Event',
            $this->container->get('ivory_google_map.event')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\Geocoding\Geocoder',
            $this->container->get('ivory_google_map.geocoder')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\Geocoding\GeocoderRequest',
            $this->container->get('ivory_google_map.geocoder_request')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\Directions\Directions',
            $this->container->get('ivory_google_map.directions')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\Directions\DirectionsRequest',
            $this->container->get('ivory_google_map.directions_request')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\DistanceMatrix\DistanceMatrix',
            $this->container->get('ivory_google_map.distance_matrix')
        );

        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Tests\Fixtures\Model\Services\DistanceMatrix\DistanceMatrixRequest',
            $this->container->get('ivory_google_map.distance_matrix_request')
        );
    }
}
