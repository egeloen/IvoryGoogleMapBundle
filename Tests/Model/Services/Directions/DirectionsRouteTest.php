<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsLeg;
use Ivory\GoogleMapBundle\Model\Services\Directions\Distance;
use Ivory\GoogleMapBundle\Model\Services\Directions\Duration;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsRoute test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute Route tested
     */
    protected static $directionsRoute = null;

    /**
     * @override
     */
    public function setUp()
    {
        $boundTest = new Bound();
        $boundTest->setSouthWest(-1.1, -2.1, true);
        $boundTest->setNorthEast(1.1, 2.1, true);

        $overviewPolyline = new EncodedPolyline('value');

        self::$directionsRoute = new DirectionsRoute($boundTest, 'copyrights', array(), $overviewPolyline, 'summary', array(), array());
    }

    /**
     * Checks the bound getter & setter
     */
    public function testBound()
    {
        $this->assertEquals(self::$directionsRoute->getBound()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals(self::$directionsRoute->getBound()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue(self::$directionsRoute->getBound()->getSouthWest()->isNoWrap());

        $this->assertEquals(self::$directionsRoute->getBound()->getNorthEast()->getLatitude(), 1.1);
        $this->assertEquals(self::$directionsRoute->getBound()->getNorthEast()->getLongitude(), 2.1);
        $this->assertTrue(self::$directionsRoute->getBound()->getSouthWest()->isNoWrap());
    }

    /**
     * Checks the copyrights getter & setter
     */
    public function testCopyrights()
    {
        $this->assertEquals(self::$directionsRoute->getCopyrights(), 'copyrights');

        self::$directionsRoute->setCopyrights('foo');
        $this->assertEquals(self::$directionsRoute->getCopyrights(), 'foo');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRoute->setCopyrights(true);
    }

    /**
     * Checks the legs getter & setter
     */
    public function testLegs()
    {
        $this->assertEquals(count(self::$directionsRoute->getLegs()), 0);

        $distance = new Distance('10 meters', 10);
        $duration = new Duration('2 minutes', 2);
        $endAddress = 'end address';
        $endLocation = new Coordinate(1.1, 2.1, true);
        $startAddress = 'start address';
        $startLocation = new Coordinate(2.1, 1.1, true);
        $directionsLegTest = new DirectionsLeg($distance, $duration, $endAddress, $endLocation, $startAddress, $startLocation, array());

        self::$directionsRoute->addLeg($directionsLegTest);
        $this->assertEquals(count(self::$directionsRoute->getLegs()), 1);

        self::$directionsRoute->setLegs(array());
        $this->assertEquals(count(self::$directionsRoute->getLegs()), 0);

        self::$directionsRoute->setLegs(array($directionsLegTest));
        $this->assertEquals(count(self::$directionsRoute->getLegs()), 1);
    }

    /**
     * Checks the overview polyline getter & setter
     */
    public function testOverviewPolyline()
    {
        $this->assertEquals(self::$directionsRoute->getOverviewPolyline()->getValue(), 'value');
    }

    /**
     * Checks the summary getter & setter
     */
    public function testSummary()
    {
        $this->assertEquals(self::$directionsRoute->getSummary(), 'summary');

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRoute->setSummary(true);
    }

    /**
     * Checks the warnings getter & setter
     */
    public function testWarnings()
    {
        $this->assertEquals(count(self::$directionsRoute->getWarnings()), 0);

        self::$directionsRoute->addWarning('warning 1');
        $this->assertEquals(count(self::$directionsRoute->getWarnings()), 1);
        $this->assertEquals(self::$directionsRoute->getWarnings(), array('warning 1'));

        self::$directionsRoute->setWarnings(array(
            'warning 1',
            'warning 2'
        ));
        $this->assertEquals(count(self::$directionsRoute->getWarnings()), 2);
        $this->assertEquals(self::$directionsRoute->getWarnings(), array('warning 1', 'warning 2'));

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRoute->addWarning(true);
    }

    /**
     * Checks the waypoint order getter & setter
     */
    public function testWaypointOrder()
    {
        $this->assertEquals(count(self::$directionsRoute->getWaypointOrder()), 0);

        self::$directionsRoute->addWaypointOrder(2);
        $this->assertEquals(self::$directionsRoute->getWaypointOrder(), array(2));

        self::$directionsRoute->setWaypointOrder(array(2, 1));
        $this->assertEquals(self::$directionsRoute->getWaypointOrder(), array(2, 1));

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsRoute->addWaypointOrder(true);
    }
}
