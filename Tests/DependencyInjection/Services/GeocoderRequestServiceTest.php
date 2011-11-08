<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Geocoder request service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestServiceTest extends WebTestCase
{
    /**
     * Checks the Geocoder request service without configuration
     */
    public function testGeocoderRequestServiceWithoutConfiguration()
    {
        $request = self::createContainer()->get('ivory_google_map.geocoder_request');
        
        $this->assertFalse($request->hasAddress());
        $this->assertFalse($request->hasCoordinate());
        $this->assertFalse($request->hasBound());
        $this->assertFalse($request->hasRegion());
        $this->assertFalse($request->hasLanguage());
        $this->assertFalse($request->hasSensor());
    }
    
    /**
     * Checks the Geocoder request service with configuration
     */
    public function testGeocoderRequestServiceWithConfiguration()
    {
        $request = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.geocoder_request');
        
        $this->assertTrue($request->hasAddress());
        $this->assertEquals($request->getAddress(), 'address');
        
        $this->assertTrue($request->hasCoordinate());
        $this->assertEquals($request->getCoordinate()->getLatitude(), 1.1);
        $this->assertEquals($request->getCoordinate()->getLongitude(), 2.1);
        $this->assertTrue($request->getCoordinate()->isNoWrap());
        
        $this->assertTrue($request->hasBound());
        $this->assertEquals($request->getBound()->getSouthWest()->getLatitude(), -3.2);
        $this->assertEquals($request->getBound()->getSouthWest()->getLongitude(), -1.4);
        $this->assertTrue($request->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals($request->getBound()->getNorthEast()->getLatitude(), 6.3);
        $this->assertEquals($request->getBound()->getNorthEast()->getLongitude(), 2.3);
        $this->assertTrue($request->getBound()->getNorthEast()->isNoWrap());
        
        $this->assertTrue($request->hasRegion());
        $this->assertEquals($request->getRegion(), 'es');
        
        $this->assertTrue($request->hasLanguage());
        $this->assertEquals($request->getLanguage(), 'en');
        
        $this->assertTrue($request->hasSensor());
    }
}
