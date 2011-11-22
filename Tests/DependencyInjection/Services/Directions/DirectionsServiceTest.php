<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Directions service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsServiceTest extends WebTestCase
{
    /**
     * Checks the Directions service without configuration
     */
    public function testDirectionsServiceWithoutConfiguration()
    {
        $directions = self::createContainer()->get('ivory_google_map.directions');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsService', $directions);
        $this->assertEquals($directions->getUrl(), 'http://maps.googleapis.com/maps/api/directions');
        $this->assertFalse($directions->isHttps());
        $this->assertEquals($directions->getFormat(), 'json');
    }
    
    /**
     * Checks the Directions service with configuration
     */
    public function testDirectionsServiceWithConfiguration()
    {
        $geocoder = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.directions');
        
        $this->assertEquals($geocoder->getUrl(), 'https://directions');
        $this->assertTrue($geocoder->isHttps());
        $this->assertEquals($geocoder->getFormat(), 'xml');
    }
}
