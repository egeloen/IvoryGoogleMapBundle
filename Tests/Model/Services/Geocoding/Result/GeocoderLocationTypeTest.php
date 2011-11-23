<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding\Result;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderLocationType;

/**
 * GeocoderLocationType test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderLocationTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $geocoderLocationTypeTest = new GeocoderLocationType();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderLocationtype" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the geocoder location types getter
     */
    public function testGeocoderLocationtypes()
    {
        $this->assertEquals(GeocoderLocationType::getGeocoderLocationTypes(), array(
            GeocoderLocationType::APPROXIMATE,
            GeocoderLocationType::GEOMETRIC_CENTER,
            GeocoderLocationType::RANGE_INTERPOLATED,
            GeocoderLocationType::ROOFTOP
        ));
    }
}
