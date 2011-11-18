<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsWaypoint;
use Ivory\GoogleMapBundle\Model\Services\Directions\TravelMode;
use Ivory\GoogleMapBundle\Model\Services\Directions\UnitSystem;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsRequest test
 *
 * @author GeLo <gelon.eric@gmail.com>
 */
class DirectionsRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest Directions request tested
     */
    protected static $directionsRequest = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$directionsRequest = new DirectionsRequest();
    }
    
    /**
     * Checks the default values
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$directionsRequest->hasAvoidHightways());
        $this->assertFalse(self::$directionsRequest->hasAvoidTolls());
        $this->assertFalse(self::$directionsRequest->hasDestination());
        $this->assertFalse(self::$directionsRequest->hasOptimizeWaypoints());
        $this->assertFalse(self::$directionsRequest->hasOrigin());
        $this->assertFalse(self::$directionsRequest->hasProvideRouteAlternatives());
        $this->assertFalse(self::$directionsRequest->hasRegion());
        $this->assertFalse(self::$directionsRequest->hasTravelMode());
        $this->assertFalse(self::$directionsRequest->hasUnitSystem());
        $this->assertFalse(self::$directionsRequest->hasWaypoints());
    }
    
    /**
     * Checks the avoid hightwayg getter & setter
     */
    public function testAvoidHightways()
    {
        self::$directionsRequest->setAvoidHighways(true);
        $this->assertTrue(self::$directionsRequest->hasAvoidHightways());
        $this->assertTrue(self::$directionsRequest->getAvoidHighways());
        
        self::$directionsRequest->setAvoidHighways(null);
        $this->assertFalse(self::$directionsRequest->hasAvoidHightways());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setAvoidHighways('foo');
    }
    
    /**
     * Checks the avoid tolls getter & setter
     */
    public function testAvoidTolls()
    {
        self::$directionsRequest->setAvoidTolls(true);
        $this->assertTrue(self::$directionsRequest->hasAvoidTolls());
        $this->assertTrue(self::$directionsRequest->getAvoidTolls());
        
        self::$directionsRequest->setAvoidTolls(null);
        $this->assertFalse(self::$directionsRequest->hasAvoidTolls());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setAvoidTolls('foo');
    }
    
    /**
     * Checks the destination getter & setter
     */
    public function testDestination()
    {
        self::$directionsRequest->setDestination('address');
        $this->assertTrue(self::$directionsRequest->hasDestination());
        $this->assertEquals(self::$directionsRequest->getDestination(), 'address');
        
        $locationTest = new Coordinate(2.1, 1.1, true);
        self::$directionsRequest->setDestination($locationTest);
        $this->assertEquals(self::$directionsRequest->getDestination()->getLatitude(), 2.1);
        $this->assertEquals(self::$directionsRequest->getDestination()->getLongitude(), 1.1);
        $this->assertTrue(self::$directionsRequest->getDestination()->isNoWrap());
        
        self::$directionsRequest->setDestination(1.1, 2.1, false);
        $this->assertEquals(self::$directionsRequest->getDestination()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsRequest->getDestination()->getLongitude(), 2.1);
        $this->assertFalse(self::$directionsRequest->getDestination()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setDestination(true);
    }
    
    /**
     * Checks the optmize waypoints getter & setter
     */
    public function testOptimizeWaypoints()
    {
        self::$directionsRequest->setOptimizeWaypoints(true);
        $this->assertTrue(self::$directionsRequest->hasOptimizeWaypoints());
        $this->assertTrue(self::$directionsRequest->getOptimizeWaypoints());
        
        self::$directionsRequest->setOptimizeWaypoints(null);
        $this->assertFalse(self::$directionsRequest->hasOptimizeWaypoints());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setOptimizeWaypoints('foo');
    }
    
    /**
     * Checks the origin getter & setter
     */
    public function testOrigin()
    {
        self::$directionsRequest->setOrigin('address');
        $this->assertTrue(self::$directionsRequest->hasOrigin());
        $this->assertEquals(self::$directionsRequest->getOrigin(), 'address');
        
        $locationTest = new Coordinate(2.1, 1.1, true);
        self::$directionsRequest->setOrigin($locationTest);
        $this->assertEquals(self::$directionsRequest->getOrigin()->getLatitude(), 2.1);
        $this->assertEquals(self::$directionsRequest->getOrigin()->getLongitude(), 1.1);
        $this->assertTrue(self::$directionsRequest->getOrigin()->isNoWrap());
        
        self::$directionsRequest->setOrigin(1.1, 2.1, false);
        $this->assertEquals(self::$directionsRequest->getOrigin()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsRequest->getOrigin()->getLongitude(), 2.1);
        $this->assertFalse(self::$directionsRequest->getOrigin()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setOrigin(true);
    }
    
    /**
     * Checks the provide route alternatives getter & setter
     */
    public function testProvideRouteAlternatives()
    {
        self::$directionsRequest->setProvideRouteAlternatives(true);
        $this->assertTrue(self::$directionsRequest->hasProvideRouteAlternatives());
        $this->assertTrue(self::$directionsRequest->getProvideRouteAlternatives());
        
        self::$directionsRequest->setProvideRouteAlternatives(null);
        $this->assertFalse(self::$directionsRequest->hasProvideRouteAlternatives());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setProvideRouteAlternatives('foo');
    }
    
    /**
     * Checks the region getter & setter
     */
    public function testRegion()
    {
        self::$directionsRequest->setRegion('fr');
        $this->assertTrue(self::$directionsRequest->hasRegion());
        $this->assertEquals(self::$directionsRequest->getRegion(), 'fr');
        
        self::$directionsRequest->setRegion(null);
        $this->assertFalse(self::$directionsRequest->hasRegion());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setRegion('foo');
    }
    
    /**
     * Checks the travel mode getter & setter
     */
    public function testTravelMode()
    {
        self::$directionsRequest->setTravelMode(TravelMode::WALKING);
        $this->assertTrue(self::$directionsRequest->hasTravelMode());
        $this->assertEquals(self::$directionsRequest->getTravelMode(), 'WALKING');
        
        self::$directionsRequest->setTravelMode(null);
        $this->assertFalse(self::$directionsRequest->hasTravelMode());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setTravelMode('foo');
    }
    
    /**
     * Checks the unit system getter & setter
     */
    public function testUnitSystem()
    {
        self::$directionsRequest->setUnitSystem(UnitSystem::IMPERIAL);
        $this->assertTrue(self::$directionsRequest->hasUnitSystem());
        $this->assertEquals(self::$directionsRequest->getUnitSystem(), 'IMPERIAL');
        
        self::$directionsRequest->setUnitSystem(null);
        $this->assertFalse(self::$directionsRequest->hasUnitSystem());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRequest->setUnitSystem('foo');
    }
    
    /**
     * Checks the waypoints getter & setter
     */
    public function testWaypoints()
    {
        $waypointTest = new DirectionsWaypoint();
        $waypointTest->setLocation('address1');
        
        self::$directionsRequest->addWaypoint($waypointTest);
        $this->assertTrue(self::$directionsRequest->hasWaypoints());
        $this->assertEquals(count(self::$directionsRequest->getWaypoints()), 1);
        
        self::$directionsRequest->addWaypoint('address2');
        $this->assertEquals(count(self::$directionsRequest->getWaypoints()), 2);
        
        self::$directionsRequest->addWaypoint(1.1, 2.2, true);
        $this->assertEquals(count(self::$directionsRequest->getWaypoints()), 3);
        
        $coordinateTest = new Coordinate(2.1, 1.2, true);
        self::$directionsRequest->addWaypoint($coordinateTest);
        $this->assertEquals(count(self::$directionsRequest->getWaypoints()), 4);
        
        $waypointsTest = array(
            $waypointTest,
            array(1.1, 2.2, true)
        );
        
        self::$directionsRequest->setWaypoints($waypointsTest);
        $this->assertEquals(count(self::$directionsRequest->getWaypoints()), 2);
    }
    
    /**
     * Checks the isValid method
     */
    public function testIsValid()
    {
        self::$directionsRequest = new DirectionsRequest();
        $this->assertFalse(self::$directionsRequest->isValid());
        
        self::$directionsRequest->setDestination('address');
        $this->assertFalse(self::$directionsRequest->isValid());
        
        self::$directionsRequest = new DirectionsRequest();
        self::$directionsRequest->setOrigin('address');
        $this->assertFalse(self::$directionsRequest->isValid());
        
        self::$directionsRequest = new DirectionsRequest();
        self::$directionsRequest->setDestination('address1');
        self::$directionsRequest->setOrigin('address2');
        $this->assertTrue(self::$directionsRequest->isValid());
        
        $waypointValidTest = new DirectionsWaypoint();
        $waypointValidTest->setLocation('address3');
        self::$directionsRequest->addWaypoint($waypointValidTest);
        $this->assertTrue(self::$directionsRequest->isValid());
        
        $waypointInvalidTest = new DirectionsWaypoint();
        self::$directionsRequest->addWaypoint($waypointInvalidTest);
        $this->assertFalse(self::$directionsRequest->isValid());
    }
}
