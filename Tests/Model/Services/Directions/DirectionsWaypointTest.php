<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsWaypoint;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsWaypoint test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsWaypoint
     */
    protected static $directionsWaypoint = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$directionsWaypoint = new DirectionsWaypoint();
    }
    
    /**
     * Checks the directions waypoint default values
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$directionsWaypoint->hasLocation());
        $this->assertFalse(self::$directionsWaypoint->hasStopover());
    }
    
    /**
     * Checks the location getter & setter
     */
    public function testLocation()
    {
        self::$directionsWaypoint->setLocation('address');
        $this->assertTrue(self::$directionsWaypoint->hasLocation());
        $this->assertEquals(self::$directionsWaypoint->getLocation(), 'address');
        
        $locationTest = new Coordinate(2.1, 1.1, true);
        self::$directionsWaypoint->setLocation($locationTest);
        $this->assertEquals(self::$directionsWaypoint->getLocation()->getLatitude(), 2.1);
        $this->assertEquals(self::$directionsWaypoint->getLocation()->getLongitude(), 1.1);
        $this->assertTrue(self::$directionsWaypoint->getLocation()->isNoWrap());
        
        self::$directionsWaypoint->setLocation(1.1, 2.1, false);
        $this->assertEquals(self::$directionsWaypoint->getLocation()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsWaypoint->getLocation()->getLongitude(), 2.1);
        $this->assertFalse(self::$directionsWaypoint->getLocation()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsWaypoint->setLocation(true);
    }
    
    /**
     * Checks the stopover getter & setter
     */
    public function testStopover()
    {
        self::$directionsWaypoint->setStopover(true);
        $this->assertTrue(self::$directionsWaypoint->hasStopover());
        $this->assertTrue(self::$directionsWaypoint->getStopover());
        
        self::$directionsWaypoint->setStopover(null);
        $this->assertFalse(self::$directionsWaypoint->hasStopover());
    }
    
    /**
     * Checks the isValid method
     */
    public function testIsValid()
    {
        $this->assertFalse(self::$directionsWaypoint->isValid());
        self::$directionsWaypoint->setLocation('foo');
        $this->assertTrue(self::$directionsWaypoint->isValid());
    }
}
