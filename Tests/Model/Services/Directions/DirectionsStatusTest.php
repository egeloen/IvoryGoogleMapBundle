<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStatus;

/**
 * DirectionsStatus test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $directionsStatusTest = new DirectionsStatus();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStatus" can not be instanciated.');
        }
        catch(\Exception $e){}
    }

    /**
     * Checks the directions status getter
     */
    public function testDirectionsStatus()
    {
        $this->assertEquals(DirectionsStatus::getDirectionsStatus(), array(
            DirectionsStatus::INVALID_REQUEST,
            DirectionsStatus::MAX_WAYPOINTS_EXCEEDED,
            DirectionsStatus::NOT_FOUND,
            DirectionsStatus::OK,
            DirectionsStatus::OVER_QUERY_LIMIT,
            DirectionsStatus::REQUEST_DENIED,
            DirectionsStatus::UNKNOWN_ERROR,
            DirectionsStatus::ZERO_RESULTS
        ));
    }
}
