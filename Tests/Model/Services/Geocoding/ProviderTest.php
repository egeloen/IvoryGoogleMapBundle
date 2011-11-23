<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Provider;
use Geocoder\HttpAdapter\BuzzHttpAdapter;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest;

/**
 * Ivory google map provider test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\Provider $provider
     */
    protected static $provider = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$provider = new Provider(new BuzzHttpAdapter());
    }
    
    /**
     * Checks the provider default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$provider->getUrl(), 'http://maps.googleapis.com/maps/api/geocode');
        $this->assertFalse(self::$provider->isHttps());
        $this->assertEquals(self::$provider->getFormat(), 'json');
    }
    
    /**
     * Checks the geocoded data method with an address
     */
    public function testGeocodedDataWithAddress()
    {
        $response = self::$provider->getGeocodedData('address');
        $this->assertInstanceOf('ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }
    
    /**
     * Checks the geocoded data method with an IP
     */
    public function testGeocdedDataWithIp()
    {
        $response = self::$provider->getGeocodedData('111.111.111.111');
        $this->assertInstanceOf('ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }
    
    /**
     * Checks the geocoded data method with a GeocoderRequest
     */
    public function testGeocodedDataWithGeocoderRequest()
    {
        $request = new GeocoderRequest();
        $request->setAddress('address');
        
        $response = self::$provider->getGeocodedData($request);
        $this->assertInstanceOf('ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }
    
    /**
     * Checks the reserved data method
     */
    public function testReversedData()
    {
        $response = self::$provider->getReversedData(array(1.1, 2.1));
        $this->assertInstanceOf('ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }
}
