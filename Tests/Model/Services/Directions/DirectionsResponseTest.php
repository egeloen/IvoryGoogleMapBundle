<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsResponse;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStatus;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

use Ivory\GoogleMapBundle\Model\Base\Bound;

/**
 * DirectionsResponse test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsResponse Directions response tested
     */
    protected static $directionsResponse = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$directionsResponse = new DirectionsResponse(array(), DirectionsStatus::OK);
    }

    /**
     * Checks the routes getter & setter
     */
    public function testRoutes()
    {
        $this->assertEquals(count(self::$directionsResponse->getRoutes()), 0);

        $boundTest = new Bound();
        $boundTest->setSouthWest(-1.1, -2.1, true);
        $boundTest->setNorthEast(1.1, 2.1, true);
        $overviewPolyline = new EncodedPolyline('value');
        $directionsRouteTest = new DirectionsRoute($boundTest, 'copyrights', array(), $overviewPolyline, 'summary', array(), array());

        self::$directionsResponse->addRoute($directionsRouteTest);
        $this->assertEquals(count(self::$directionsResponse->getRoutes()), 1);
    }

    /**
     * Checks the status getter & setter
     */
    public function testStatus()
    {
        $this->assertEquals(self::$directionsResponse->getStatus(), DirectionsStatus::OK);

        self::$directionsResponse->setStatus(DirectionsStatus::INVALID_REQUEST);
        $this->assertEquals(self::$directionsResponse->getStatus(), DirectionsStatus::INVALID_REQUEST);

        $this->setExpectedException('InvalidArgumentException');
        self::$directionsResponse->setStatus('foo');
    }
}

