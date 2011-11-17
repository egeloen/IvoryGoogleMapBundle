<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Geocoder;

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
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Geocoder\Geocoder', $geocoder);
        $this->assertEquals($geocoder->getUrl(), 'http://maps.googleapis.com/maps/api/geocode');
        $this->assertFalse($geocoder->isHttps());
        $this->assertEquals($geocoder->getFormat(), 'json');
    }
    
    /**
     * Checks the Geocoder service with configuration
     */
    public function testGeocoderServiceWithConfiguration()
    {
        $geocoder = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.geocoder');
        
        $this->assertEquals($geocoder->getUrl(), 'https://geocoder');
        $this->assertTrue($geocoder->isHttps());
        $this->assertEquals($geocoder->getFormat(), 'xml');
    }
}
