<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Base\Bound;

/**
 * GeocoderRequest test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest Geocoder request tested
     */
    protected static $geocoderRequest = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$geocoderRequest = new GeocoderRequest();
    }
    
    /**
     * Checks geocoder request default values
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$geocoderRequest->hasAddress());
        $this->assertFalse(self::$geocoderRequest->hasCoordinate());
        $this->assertFalse(self::$geocoderRequest->hasBound());
        $this->assertFalse(self::$geocoderRequest->hasRegion());
        $this->assertFalse(self::$geocoderRequest->hasLanguage());
        $this->assertFalse(self::$geocoderRequest->hasSensor());
    }
    
    /**
     * Checks the addresse getter & setter
     */
    public function testAddress()
    {
        self::$geocoderRequest->setAddress('address');
        $this->assertTrue(self::$geocoderRequest->hasAddress());
        $this->assertEquals(self::$geocoderRequest->getAddress(), 'address');
        
        self::$geocoderRequest->setAddress(null);
        $this->assertFalse(self::$geocoderRequest->hasAddress());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setAddress(true);
    }
    
    /**
     * Checks the coordinate getter & settr
     */
    public function testCoordinate()
    {
        $coordinateTest = new Coordinate(1.2, -1.8, true);
        self::$geocoderRequest->setCoordinate($coordinateTest);
        $this->assertTrue(self::$geocoderRequest->hasCoordinate());
        $this->assertEquals(self::$geocoderRequest->getCoordinate()->getLatitude(), 1.2);
        $this->assertEquals(self::$geocoderRequest->getCoordinate()->getLongitude(), -1.8);
        $this->assertTrue(self::$geocoderRequest->getCoordinate()->isNoWrap());
        
        self::$geocoderRequest->setCoordinate(1.1, -2.1, false);
        $this->assertTrue(self::$geocoderRequest->hasCoordinate());
        $this->assertEquals(self::$geocoderRequest->getCoordinate()->getLatitude(), 1.1);
        $this->assertEquals(self::$geocoderRequest->getCoordinate()->getLongitude(), -2.1);
        $this->assertFalse(self::$geocoderRequest->getCoordinate()->isNoWrap());
        
        self::$geocoderRequest->setCoordinate(null);
        $this->assertFalse(self::$geocoderRequest->hasCoordinate());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setCoordinate('foo');
    }
    
    /**
     * Checks the bound getter & setter
     */
    public function testBound()
    {
        $southWestCoordinateTest = new Coordinate(-1, -1, true);
        $northEastCoordinateTest = new Coordinate(1, 1, true);
        
        $boundTest = new Bound();
        $boundTest->setSouthWest($southWestCoordinateTest);
        $boundTest->setNorthEast($northEastCoordinateTest);
        self::$geocoderRequest->setBound($boundTest);
        $this->assertTrue(self::$geocoderRequest->hasBound());
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue(self::$geocoderRequest->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$geocoderRequest->getBound()->getNorthEast()->isNoWrap());
        
        self::$geocoderRequest->setBound($southWestCoordinateTest, $northEastCoordinateTest);
        $this->assertTrue(self::$geocoderRequest->hasBound());
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue(self::$geocoderRequest->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$geocoderRequest->getBound()->getNorthEast()->isNoWrap());
        
        self::$geocoderRequest->setBound(-2, -2, 2, 2, true, true);
        $this->assertTrue(self::$geocoderRequest->hasBound());
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLatitude(), -2);
        $this->assertEquals(self::$geocoderRequest->getBound()->getSouthWest()->getLongitude(), -2);
        $this->assertTrue(self::$geocoderRequest->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLatitude(), 2);
        $this->assertEquals(self::$geocoderRequest->getBound()->getNorthEast()->getLongitude(), 2);
        $this->assertTrue(self::$geocoderRequest->getBound()->getNorthEast()->isNoWrap());
        
        self::$geocoderRequest->setBound(null);
        $this->assertFalse(self::$geocoderRequest->hasBound());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setBound('foo');
    }
    
    /**
     * Checks the region getter & setter
     */
    public function testRegion()
    {
        self::$geocoderRequest->setRegion('fr');
        $this->assertTrue(self::$geocoderRequest->hasRegion());
        $this->assertEquals(self::$geocoderRequest->getRegion(), 'fr');
        
        self::$geocoderRequest->setRegion(null);
        $this->assertFalse(self::$geocoderRequest->hasRegion());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setRegion('foo');
    }
    
    /**
     * Checks the language getter & setter
     */
    public function testLanguage()
    {
        self::$geocoderRequest->setLanguage('fr');
        $this->assertTrue(self::$geocoderRequest->hasLanguage());
        $this->assertEquals(self::$geocoderRequest->getLanguage(), 'fr');
        
        self::$geocoderRequest->setLanguage(null);
        $this->assertFalse(self::$geocoderRequest->hasLanguage());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setLanguage(true);
    }
    
    /**
     * Checks the sensor getter & setter
     */
    public function testSensor()
    {
        self::$geocoderRequest->setSensor(true);
        $this->assertTrue(self::$geocoderRequest->hasSensor());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderRequest->setSensor('foo');
    }
    
    /**
     * Checks the isValid method
     */
    public function testIsValid()
    {
        self::$geocoderRequest->setAddress(null);
        self::$geocoderRequest->setCoordinate(null);
        $this->assertFalse(self::$geocoderRequest->isValid());
        
        self::$geocoderRequest->setAddress('address');
        self::$geocoderRequest->setCoordinate(null);
        $this->assertTrue(self::$geocoderRequest->isValid());
        
        self::$geocoderRequest->setAddress(null);
        self::$geocoderRequest->setCoordinate(1, 1, true);
        $this->assertTrue(self::$geocoderRequest->isValid());
    }
}
