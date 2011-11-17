<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Tests\Model\Services\AbstractServiceTest;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Geocoder;

/**
 * Geocoder test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends AbstractServiceTest
{
    /**
     * @override
     */
    public function setUp()
    {
        self::$service = new Geocoder();
    }
    
    /**
     * Checks the geocoder default values
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();
        
        $this->assertEquals(self::$service->getUrl(), 'http://maps.googleapis.com/maps/api/geocode');
    }
    
    /**
     * Checks the geocoloate method
     * 
     * @todo Finish implementation, i'm tired... :s
     */
    public function testGeolocate()
    {
        
    }
}
