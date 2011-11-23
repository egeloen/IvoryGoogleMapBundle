<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Geocoding;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Geocoder service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderServiceTest extends WebTestCase
{
    /**
     * Checks the Geocoder service without configuration
     */
    public function testGeocoderServiceWithoutConfiguration()
    {
        $geocoder = self::createContainer()->get('ivory_google_map.geocoder');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Geocoding\Geocoder', $geocoder);
    }
    
    /**
     * Checks the Geocoder service with configuration
     */
    public function testGeocoderServiceWithConfiguration()
    {
        $geocoder = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.geocoder');
    }
}
