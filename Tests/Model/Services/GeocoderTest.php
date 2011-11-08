<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services;

use Ivory\GoogleMapBundle\Model\Services\Geocoder;

/**
 * Geocoder test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoder
     */
    protected static $geocoder = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$geocoder = new Geocoder();
    }
    
    /**
     * Checks the geocoder default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$geocoder->getUrl(), 'http://maps.googleapis.com/maps/api/geocode');
        $this->assertFalse(self::$geocoder->isHttps());
        $this->assertEquals(self::$geocoder->getFormat(), 'json');
    }
    
    /**
     * Checks the browser getter
     */
    public function testBrowser()
    {
        $this->assertInstanceOf('Buzz\Browser', self::$geocoder->getBrowser());
    }
    
    /**
     * Checks the url getter & setter
     */
    public function testUrl()
    {
        self::$geocoder->setUrl('http://someurl');
        $this->assertEquals(self::$geocoder->getUrl(), 'http://someurl');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoder->setUrl(true);
        
        self::$geocoder->setUrl('http://maps.googleapis.com/maps/api/geocode');
    }
    
    /**
     * Checks the https getter & setter
     */
    public function testHttps()
    {
        self::$geocoder->setHttps(true);
        $this->assertTrue(self::$geocoder->isHttps());
        $this->assertEquals(self::$geocoder->getUrl(), 'https://maps.googleapis.com/maps/api/geocode');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoder->setHttps('foo');
        
        self::$geocoder->setHttps(false);
    }
    
    /**
     * Checks the format getter & setter
     */
    public function testFormat()
    {
        self::$geocoder->setFormat('xml');
        $this->assertEquals(self::$geocoder->getFormat(), 'xml');
        
        self::$geocoder->setFormat('json');
        $this->assertEquals(self::$geocoder->getFormat(), 'json');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoder->setFormat('foo');
    }
    
    /**
     * Checks the geocoloate method
     * 
     * @todo Finish implementation, i'm tired...
     */
    public function testGeolocate()
    {
        
    }
}
