<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderGeometry;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderLocationType;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * GeocoderGeometry test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderGeometry
     */
    protected static $geocoderGeometry = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        $viewportTest = new Bound();
        $viewportTest->setSouthWest(-1.1, -2.1, true);
        $viewportTest->setNorthEast(2.1, 1.1, true);
        
        $boundTest = new Bound();
        $boundTest->setSouthWest(-5.1, -4.1, true);
        $boundTest->setNorthEast(4.1, 5.1, true);
        self::$geocoderGeometry = new GeocoderGeometry(new Coordinate(1, 2, true), GeocoderLocationType::APPROXIMATE, $viewportTest, $boundTest);
    }
    
    /**
     * Checks geocoder geometry default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$geocoderGeometry->getLocation()->getLatitude(), 1);
        $this->assertEquals(self::$geocoderGeometry->getLocation()->getLongitude(), 2);
        $this->assertTrue(self::$geocoderGeometry->getLocation()->isNoWrap());
        
        $this->assertEquals(self::$geocoderGeometry->getLocationType(), GeocoderLocationType::APPROXIMATE);
        
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue(self::$geocoderGeometry->getViewport()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getNorthEast()->getLatitude(), 2.1);
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getNorthEast()->getLongitude(), 1.1);
        $this->assertTrue(self::$geocoderGeometry->getViewport()->getNorthEast()->isNoWrap());
        
        $this->assertEquals(self::$geocoderGeometry->getBound()->getSouthWest()->getLatitude(), -5.1);
        $this->assertEquals(self::$geocoderGeometry->getBound()->getSouthWest()->getLongitude(), -4.1);
        $this->assertTrue(self::$geocoderGeometry->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderGeometry->getBound()->getNorthEast()->getLatitude(), 4.1);
        $this->assertEquals(self::$geocoderGeometry->getBound()->getNorthEast()->getLongitude(), 5.1);
        $this->assertTrue(self::$geocoderGeometry->getBound()->getNorthEast()->isNoWrap());
    }
    
    /**
     * Checks the location getter & setter
     */
    public function testLocation()
    {
        $locationTest = new Coordinate(1.1, 2.1, false);
        self::$geocoderGeometry->setLocation($locationTest);
        
        $this->assertEquals(self::$geocoderGeometry->getLocation()->getLatitude(), 1.1);
        $this->assertEquals(self::$geocoderGeometry->getLocation()->getLongitude(), 2.1);
        $this->assertFalse(self::$geocoderGeometry->getLocation()->isNoWrap());
    }
    
    /**
     * Checks the location type getter & setter
     */
    public function testLocationType()
    {
        self::$geocoderGeometry->setLocationType(GeocoderLocationType::GEOMETRIC_CENTER);
        $this->assertEquals(self::$geocoderGeometry->getLocationType(), GeocoderLocationType::GEOMETRIC_CENTER);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderGeometry->setLocationType('foo');
    }
    
    /**
     * Checks the viewport getter & setter
     */
    public function testViewport()
    {
        $viewportTest = new Bound();
        $viewportTest->setSouthWest(-9.1, -6.1, true);
        $viewportTest->setNorthEast(3.1, 1.1, false);
        self::$geocoderGeometry->setViewport($viewportTest);
        
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getSouthWest()->getLatitude(), -9.1);
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getSouthWest()->getLongitude(), -6.1);
        $this->assertTrue(self::$geocoderGeometry->getViewport()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getNorthEast()->getLatitude(), 3.1);
        $this->assertEquals(self::$geocoderGeometry->getViewport()->getNorthEast()->getLongitude(), 1.1);
        $this->assertFalse(self::$geocoderGeometry->getViewport()->getNorthEast()->isNoWrap());
    }
    
    /**
     * Checks the bound getter & setter
     */
    public function testBound()
    {
        $boundTest = new Bound();
        $boundTest->setSouthWest(-4.1, -8.1, false);
        $boundTest->setNorthEast(7.1, 3.1, true);
        self::$geocoderGeometry->setBound($boundTest);
        
        $this->assertEquals(self::$geocoderGeometry->getBound()->getSouthWest()->getLatitude(), -4.1);
        $this->assertEquals(self::$geocoderGeometry->getBound()->getSouthWest()->getLongitude(), -8.1);
        $this->assertFalse(self::$geocoderGeometry->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderGeometry->getBound()->getNorthEast()->getLatitude(), 7.1);
        $this->assertEquals(self::$geocoderGeometry->getBound()->getNorthEast()->getLongitude(), 3.1);
        $this->assertTrue(self::$geocoderGeometry->getBound()->getNorthEast()->isNoWrap());
    }
}
