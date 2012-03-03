<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsLeg;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStep;
use Ivory\GoogleMapBundle\Model\Services\Directions\Distance;
use Ivory\GoogleMapBundle\Model\Services\Directions\Duration;
use Ivory\GoogleMapBundle\Model\Services\Directions\TravelMode;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsLeg test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLegTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsLeg Directions leg tested
     */
    protected static $directionsLeg = null;

    /**
     * @override
     */
    public function setUp()
    {
        $distance = new Distance('10 meters', 10);
        $duration = new Duration('2 minutes', 2);
        $endAddress = 'end address';
        $endLocation = new Coordinate(1.1, 2.1, true);
        $startAddress = 'start address';
        $startLocation = new Coordinate(2.1, 1.1, true);

        self::$directionsLeg = new DirectionsLeg($distance, $duration, $endAddress, $endLocation, $startAddress, $startLocation, array());
    }

    /**
     * Checks the distance getter & setter
     */
    public function testDistance()
    {
        $this->assertEquals(self::$directionsLeg->getDistance()->getText(), '10 meters');
        $this->assertEquals(self::$directionsLeg->getDistance()->getValue(), 10);
    }

    /**
     * Checks the duration getter & setter
     */
    public function testDuration()
    {
        $this->assertEquals(self::$directionsLeg->getDuration()->getText(), '2 minutes');
        $this->assertEquals(self::$directionsLeg->getDuration()->getValue(), 2);
    }

    /**
     * Checks the end address getter & setter
     */
    public function testEndAddress()
    {
        $this->assertEquals(self::$directionsLeg->getEndAddress(), 'end address');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsLeg->setEndAddress(true);
    }

    /**
     * Checks the end location getter & setter
     */
    public function testEndLocation()
    {
        $this->assertEquals(self::$directionsLeg->getEndLocation()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsLeg->getEndLocation()->getLongitude(), 2.1);
        $this->assertTrue(self::$directionsLeg->getEndLocation()->isNoWrap());
    }

    /**
     * Checks the start address getter & setter
     */
    public function testStartAddress()
    {
        $this->assertEquals(self::$directionsLeg->getStartAddress(), 'start address');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsLeg->setStartAddress(true);
    }

    /**
     * Checks the start location getter & setter
     */
    public function testStartLocation()
    {
        $this->assertEquals(self::$directionsLeg->getStartLocation()->getLatitude(), 2.1);
        $this->assertEquals(self::$directionsLeg->getStartLocation()->getLongitude(), 1.1);
        $this->assertTrue(self::$directionsLeg->getStartLocation()->isNoWrap());
    }

    /**
     * Checks the steps getter & setter
     */
    public function testSteps()
    {
        $this->assertEquals(count(self::$directionsLeg->getSteps()), 0);

        $distance = new Distance('10 meters', 10);
        $duration = new Duration('2 minutes', 2);
        $endLocation = new Coordinate(1.1, 2.1, true);
        $instructions = 'instructions';
        $encodedPolyline = new EncodedPolyline('value');
        $startLocation = new Coordinate(2.1, 1.1, true);
        $travelMode = TravelMode::DRIVING;

        $directionsStepTest = new DirectionsStep($distance, $duration, $endLocation, $instructions, $encodedPolyline, $startLocation, $travelMode);
        self::$directionsLeg->addStep($directionsStepTest);

        $this->assertEquals(count(self::$directionsLeg->getSteps()), 1);

        self::$directionsLeg->setSteps(array());
        $this->assertEquals(count(self::$directionsLeg->getSteps()), 0);

        self::$directionsLeg->setSteps(array($directionsStepTest));
        $this->assertEquals(count(self::$directionsLeg->getSteps()), 1);
    }
}
