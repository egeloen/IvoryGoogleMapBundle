<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractJavascriptVariableAssetTest;

use Ivory\GoogleMapBundle\Model;
use Ivory\GoogleMapBundle\Model\Base;
use Ivory\GoogleMapBundle\Model\Controls;
use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Map test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Map Tested map
     */
    protected static $map = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$map = new Model\Map();
    }
    
    /**
     * @override
     */
    public function testJavascriptVariable() 
    {
        $this->assertEquals(substr(self::$map->getJavascriptVariable(), 0, 4), 'map_');
    }
    
    /**
     * Checks the map default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$map->getHtmlContainerId(), 'map_canvas');
        $this->assertFalse(self::$map->isAutoZoom());
        $this->assertEquals(self::$map->getCenter()->getLatitude(), 0);
        $this->assertEquals(self::$map->getCenter()->getLongitude(), 0);
        $this->assertTrue(self::$map->getCenter()->isNoWrap());
        $this->assertNull(self::$map->getBound()->getNorthEast());
        $this->assertNull(self::$map->getBound()->getSouthWest());
        $this->assertEquals(count(self::$map->getBound()->getExtends()), 0);
        $this->assertEquals(self::$map->getMapOptions(), array(
            'mapTypeId' => 'roadmap',
            'zoom' => 3
        ));
        $this->assertEquals(self::$map->getStylesheetOptions(), array(
            'width' => '300px',
            'height' => '300px'
        ));
        $this->assertNull(self::$map->getMapTypeControl());
        $this->assertNull(self::$map->getOverviewMapControl());
        $this->assertNull(self::$map->getPanControl());
        $this->assertNull(self::$map->getRotateControl());
        $this->assertNull(self::$map->getScaleControl());
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\EventManager', self::$map->getEventManager());
        $this->assertEquals(count(self::$map->getMarkers()), 0);
        $this->assertEquals(count(self::$map->getInfoWindows()), 0);
        $this->assertEquals(count(self::$map->getPolylines()), 0);
        $this->assertEquals(count(self::$map->getPolygons()), 0);
        $this->assertEquals(count(self::$map->getRectangles()), 0);
        $this->assertEquals(count(self::$map->getCircles()), 0);
        $this->assertEquals(count(self::$map->getGroundOverlays()), 0);
    }
    
    /**
     * Checks the HTML container id getter & setter
     */
    public function testHtmlContainerId()
    {
        self::$map->setHtmlContainerId('html_container_id');
        $this->assertEquals(self::$map->getHtmlContainerId(), 'html_container_id');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setHtmlContainerId(0);
    }
    
    /**
     * Checks the auto zoom getter & setter
     */
    public function testAutoZoom()
    {
        self::$map->setAutoZoom(true);
        $this->assertTrue(self::$map->isAutoZoom());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setAutoZoom('foo');
    }
    
    /**
     * Checks the center getter & setter
     */
    public function testCenter()
    {
        $coordinateTest = new Base\Coordinate(1, 1, true);
        self::$map->setCenter($coordinateTest);
        $this->assertEquals(self::$map->getCenter()->getLatitude(), 1);
        $this->assertEquals(self::$map->getCenter()->getLongitude(), 1);
        $this->assertTrue(self::$map->getCenter()->isNoWrap());
        
        self::$map->setCenter(2, 2, false);
        $this->assertEquals(self::$map->getCenter()->getLatitude(), 2);
        $this->assertEquals(self::$map->getCenter()->getLongitude(), 2);
        $this->assertFalse(self::$map->getCenter()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setCenter('foo');
    }
    
    /**
     * Checks the bound getter & setter
     */
    public function testBound()
    {
        $boundTest = new Base\Bound();
        self::$map->setBound($boundTest);
        $this->assertNull(self::$map->getBound()->getNorthEast());
        $this->assertNull(self::$map->getBound()->getSouthWest());
        $this->assertEquals(count(self::$map->getBound()->getExtends()), 0);
        
        $southWestCoordinateTest = new Base\Coordinate(-1, -1, true);
        $northEastCoordinateTest = new Base\Coordinate(1, 1, true);
        self::$map->setBound($southWestCoordinateTest, $northEastCoordinateTest);
        $this->assertEquals(self::$map->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$map->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue(self::$map->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$map->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals(self::$map->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$map->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals(count(self::$map->getBound()->getExtends()), 0);
        
        self::$map->setBound(-2, -2, 2, 2, true, true);
        $this->assertEquals(self::$map->getBound()->getSouthWest()->getLatitude(), -2);
        $this->assertEquals(self::$map->getBound()->getSouthWest()->getLongitude(), -2);
        $this->assertTrue(self::$map->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$map->getBound()->getNorthEast()->getLatitude(), 2);
        $this->assertEquals(self::$map->getBound()->getNorthEast()->getLongitude(), 2);
        $this->assertTrue(self::$map->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals(count(self::$map->getBound()->getExtends()), 0);
    }
    
    /**
     * Checks the map options getter & setter
     */
    public function testMapOptions()
    {
        $validMapOptionsTest = array(
            'option1' => 'value1',
            'option2' => 'value2'
        );
        
        self::$map->setMapOptions($validMapOptionsTest);
        $this->assertEquals(count(self::$map->getMapOptions()), 4);
        
        $invalidMapOptionsTest = array(
            0 => 'value1',
            1 => 'value2'
        );
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setMapOptions($invalidMapOptionsTest);
        
        $this->assertEquals(self::$map->getMapOption('option1'), 'value1');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->getMapOption(0);
    }
    
    /**
     * Checks the stylesheet options getter & setter
     */
    public function testStylesheetOptions()
    {
        $validStylesheetOptionsTest = array(
            'option1' => 'value1',
            'option2' => 'value2'
        );
        
        self::$map->setStylesheetOptions($validStylesheetOptionsTest);
        $this->assertEquals(count(self::$map->getStylesheetOptions()), 4);
        
        $invalidStylesheetOptionsTest = array(
            0 => 'value1',
            1 => 'value2'
        );
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setStylesheetOptions($invalidStylesheetOptionsTest);
        
        $this->assertEquals(self::$map->getStylesheetOption('option1'), 'value1');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->getStylesheetOption(0);
    }
    
    /**
     * Checks the map type control getter & setter
     */
    public function testMapTypeControl()
    {
        $mapTypeControlTest = new Controls\MapTypeControl();
        $mapTypeControlTest->setMapTypeIds(array(Model\MapTypeId::ROADMAP));
        $mapTypeControlTest->setControlPosition(Controls\ControlPosition::BOTTOM_CENTER);
        $mapTypeControlTest->setMapTypeControlStyle(Controls\MapTypeControlStyle::HORIZONTAL_BAR);
        self::$map->setMapTypeControl($mapTypeControlTest);
        $this->assertEquals(self::$map->getMapTypeControl()->getMapTypeIds(), array('roadmap'));
        $this->assertEquals(self::$map->getMapTypeControl()->getControlPosition(), 'bottom_center');
        $this->assertEquals(self::$map->getMapTypeControl()->getMapTypeControlStyle(), 'horizontal_bar');
        
        self::$map->setMapTypeControl(array(Model\MapTypeId::SATELLITE), Controls\ControlPosition::BOTTOM_LEFT, Controls\MapTypeControlStyle::DROPDOWN_MENU);
        $this->assertEquals(self::$map->getMapTypeControl()->getMapTypeIds(), array('satellite'));
        $this->assertEquals(self::$map->getMapTypeControl()->getControlPosition(), 'bottom_left');
        $this->assertEquals(self::$map->getMapTypeControl()->getMapTypeControlStyle(), 'dropdown_menu');
        
        self::$map->setMapTypeControl(null);
        $this->assertNull(self::$map->getMapTypeControl());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setMapTypeControl('foo');
    }
    
    /**
     * Checks the overview map control getter & setter
     */
    public function testOverviewMapControl()
    {
        $overviewMapControlTest = new Controls\OverviewMapControl();
        $overviewMapControlTest->setOpened(true);
        self::$map->setOverviewMapControl($overviewMapControlTest);
        $this->assertTrue(self::$map->getOverviewMapControl()->isOpened());
        
        self::$map->setOverviewMapControl(false);
        $this->assertFalse(self::$map->getOverviewMapControl()->isOpened());
        
        self::$map->setOverviewMapControl(null);
        $this->assertNull(self::$map->getOverviewMapControl());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setOverviewMapControl('foo');
    }
    
    /**
     * Checks the map pan control getter & setter
     */
    public function testPanControl()
    {
        $panControlTest = new Controls\PanControl();
        $panControlTest->setControlPosition(Controls\ControlPosition::BOTTOM_CENTER);
        self::$map->setPanControl($panControlTest);
        $this->assertEquals(self::$map->getPanControl()->getControlPosition(), 'bottom_center');
        
        self::$map->setPanControl(Controls\ControlPosition::BOTTOM_LEFT);
        $this->assertEquals(self::$map->getPanControl()->getControlPosition(), 'bottom_left');
        
        self::$map->setPanControl(null);
        $this->assertNull(self::$map->getPanControl());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setPanControl('foo');
    }
    
    /**
     * Checks the map rotate control getter & setter
     */
    public function testRotateControl()
    {
        $rotateControlTest = new Controls\RotateControl();
        $rotateControlTest->setControlPosition(Controls\ControlPosition::BOTTOM_CENTER);
        self::$map->setRotateControl($rotateControlTest);
        $this->assertEquals(self::$map->getRotateControl()->getControlPosition(), 'bottom_center');
        
        self::$map->setRotateControl(Controls\ControlPosition::BOTTOM_LEFT);
        $this->assertEquals(self::$map->getRotateControl()->getControlPosition(), 'bottom_left');
        
        self::$map->setRotateControl(null);
        $this->assertNull(self::$map->getRotateControl());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setRotateControl('foo');
    }
    
    /**
     * Checks the map scale control getter & setter
     */
    public function testScaleControl()
    {
        $scaleControlTest = new Controls\ScaleControl();
        $scaleControlTest->setControlPosition(Controls\ControlPosition::BOTTOM_CENTER);
        $scaleControlTest->setScaleControlStyle(Controls\ScaleControlStyle::DEFAULT_);
        self::$map->setScaleControl($scaleControlTest);
        $this->assertEquals(self::$map->getScaleControl()->getControlPosition(), 'bottom_center');
        $this->assertEquals(self::$map->getScaleControl()->getScaleControlStyle(), 'default');
        
        self::$map->setScaleControl(Controls\ControlPosition::BOTTOM_LEFT, Controls\ScaleControlStyle::DEFAULT_);
        $this->assertEquals(self::$map->getScaleControl()->getControlPosition(), 'bottom_left');
        $this->assertEquals(self::$map->getScaleControl()->getScaleControlStyle(), 'default');
        
        self::$map->setScaleControl(null);
        $this->assertNull(self::$map->getScaleControl());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$map->setScaleControl('foo');
    }
    
    /**
     * Checks the event manager getter & setter
     */
    public function testEventManager()
    {
        $eventManagerTest = new Model\EventManager();
        $eventTest = new Model\Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        $eventTest->setCapture(true);
        $eventManagerTest->addEvent($eventTest);
        self::$map->setEventManager($eventManagerTest);
        
        $events = self::$map->getEventManager()->getEvents();
        $this->assertEquals($events[0]->getInstance(), 'instance');
        $this->assertEquals($events[0]->getEventName(), 'event_name');
        $this->assertEquals($events[0]->getHandle(), 'handle');
        $this->assertTrue($events[0]->isCapture());
    }
    
    /**
     * Checks the markers getter & setter
     */
    public function testMarkers()
    {
        self::$map->setAutoZoom(true);
        
        $markerTest = new Overlays\Marker();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($markerTest));
        
        self::$map->setBound($boundMock);
        self::$map->addMarker($markerTest);
        
        $this->assertEquals(count(self::$map->getMarkers()), 1);
    }
    
    /**
     * Checks the info windows getter & setter
     */
    public function testInfoWindows()
    {
        self::$map->setAutoZoom(true);
        
        $infoWindowTest = new Overlays\InfoWindow();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($infoWindowTest));
        
        self::$map->setBound($boundMock);
        self::$map->addInfoWindow($infoWindowTest);
        
        $this->assertEquals(count(self::$map->getInfoWindows()), 1);
    }
    
    /**
     * Checks the polylines getter & setter
     */
    public function testPolylines()
    {
        self::$map->setAutoZoom(true);
        
        $polylineTest = new Overlays\Polyline();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($polylineTest));
        
        self::$map->setBound($boundMock);
        self::$map->addPolyline($polylineTest);
        
        $this->assertEquals(count(self::$map->getPolylines()), 1);
    }
    
    /**
     * Checks the polygons getter & setter
     */
    public function testPolygons()
    {
        self::$map->setAutoZoom(true);
        
        $polygonTest = new Overlays\Polygon();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($polygonTest));
        
        self::$map->setBound($boundMock);
        self::$map->addPolygon($polygonTest);
        
        $this->assertEquals(count(self::$map->getPolygons()), 1);
    }
    
    /**
     * Checks the rectangle getter & setter
     */
    public function testRectangles()
    {
        self::$map->setAutoZoom(true);
        
        $rectangleTest = new Overlays\Rectangle();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($rectangleTest));
        
        self::$map->setBound($boundMock);
        self::$map->addRectangle($rectangleTest);
        
        $this->assertEquals(count(self::$map->getRectangles()), 1);
    }
    
    /**
     * Checks the circle getter & setter
     */
    public function testCircles()
    {
        self::$map->setAutoZoom(true);
        
        $circleTest = new Overlays\Circle();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($circleTest));
        
        self::$map->setBound($boundMock);
        self::$map->addCircle($circleTest);
        
        $this->assertEquals(count(self::$map->getCircles()), 1);
    }
    
    /**
     * Checks the ground overlay getter & setter
     */
    public function testGroundOverlays()
    {
        self::$map->setAutoZoom(true);
        
        $groundOverlayTest = new Overlays\GroundOverlay();
        $boundMock = $this->getMock('Ivory\GoogleMapBundle\Model\Base\Bound', array('extend'));
        $boundMock->expects($this->once())
                  ->method('extend')
                  ->with($this->equalTo($groundOverlayTest));
        
        self::$map->setBound($boundMock);
        self::$map->addGroundOverlay($groundOverlayTest);
        
        $this->assertEquals(count(self::$map->getGroundOverlays()), 1);
    }
}
