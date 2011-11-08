<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services;

use Ivory\GoogleMapBundle\Model\Services\GeocoderStatus;

/**
 * GeocoderStatus test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderStatusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $geocoderStatusTest = new GeocoderStatus();
            $this->fail('The class "\Ivory\GoogleMapBundle\Model\Services\GeocoderStatus" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the geocoder status getter
     */
    public function testGeocoderStatus()
    {
        $this->assertEquals(GeocoderStatus::getGeocoderStatus(), array(
            GeocoderStatus::ERROR,
            GeocoderStatus::INVALID_REQUEST,
            GeocoderStatus::OK,
            GeocoderStatus::OVER_QUERY_LIMIT,
            GeocoderStatus::REQUEST_DENIED,
            GeocoderStatus::UNKNOWN_ERROR,
            GeocoderStatus::ZERO_RESULTS
        ));
    }
}
