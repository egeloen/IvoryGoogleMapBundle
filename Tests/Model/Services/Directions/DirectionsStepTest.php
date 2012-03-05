<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStep;
use Ivory\GoogleMapBundle\Model\Services\Directions\Distance;
use Ivory\GoogleMapBundle\Model\Services\Directions\Duration;
use Ivory\GoogleMapBundle\Model\Services\Directions\TravelMode;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsStep test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStepTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStep Directions step tested
     */
    protected static $directionsStep = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $distance = new Distance('10 meters', 10);
        $duration = new Duration('2 minutes', 2);
        $endLocation = new Coordinate(1.1, 2.1, true);
        $instructions = 'instructions';
        $encodedPolyline = new EncodedPolyline('value');
        $startLocation = new Coordinate(2.1, 1.1, true);
        $travelMode = TravelMode::DRIVING;

        self::$directionsStep = new DirectionsStep($distance, $duration, $endLocation, $instructions, $encodedPolyline, $startLocation, $travelMode);
    }

    /**
     * Checks the distance getter & setter
     */
    public function testDistance()
    {
        $this->assertEquals(self::$directionsStep->getDistance()->getText(), '10 meters');
        $this->assertEquals(self::$directionsStep->getDistance()->getValue(), 10);
    }

    /**
     * Checks the duration getter & setter
     */
    public function testDuration()
    {
        $this->assertEquals(self::$directionsStep->getDuration()->getText(), '2 minutes');
        $this->assertEquals(self::$directionsStep->getDuration()->getValue(), 2);
    }

    /**
     * Checks the end location getter & setter
     */
    public function testEndLocation()
    {
        $this->assertEquals(self::$directionsStep->getEndLocation()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsStep->getEndLocation()->getLongitude(), 2.1);
        $this->assertTrue(self::$directionsStep->getEndLocation()->isNoWrap());
    }

    /**
     * Checks the instructions getter & setter
     */
    public function testInstructions()
    {
        $this->assertEquals(self::$directionsStep->getInstructions(), 'instructions');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsStep->setInstructions(true);
    }

    /**
     * Checks the encoded polyline getter & setter
     */
    public function testEncodedPolyline()
    {
        $this->assertEquals(self::$directionsStep->getEncodedPolyline()->getValue(), 'value');
    }

    /**
     * Checks the start location getter & setter
     */
    public function testStartLocation()
    {
        $this->assertEquals(self::$directionsStep->getStartLocation()->getLatitude(), 2.1);
        $this->assertEquals(self::$directionsStep->getStartLocation()->getLongitude(), 1.1);
        $this->assertTrue(self::$directionsStep->getStartLocation()->isNoWrap());
    }

    /**
     * Checks the travel mode getter & setter
     */
    public function testTravelMode()
    {
        $this->assertEquals(self::$directionsStep->getTravelMode(), 'DRIVING');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsStep->setTravelMode('foo');
    }
}
