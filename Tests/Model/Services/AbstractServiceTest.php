<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services;

/**
 * AbstractService test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\AbstractService $service
     */
    protected static $service = null;
    
    /**
     * Checks the geocoder default values
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$service->isHttps());
        $this->assertEquals(self::$service->getFormat(), 'json');
    }
    
    /**
     * Checks the browser getter
     */
    public function testBrowser()
    {
        $this->assertInstanceOf('Buzz\Browser', self::$service->getBrowser());
    }
    
    /**
     * Checks the url getter & setter
     */
    public function testUrl()
    {
        $url = self::$service->getUrl();
        
        self::$service->setUrl('http://someurl');
        $this->assertEquals(self::$service->getUrl(), 'http://someurl');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$service->setUrl(true);
        
        self::$service->setUrl($url);
    }
    
    /**
     * Checks the https getter & setter
     */
    public function testHttps()
    {
        self::$service->setHttps(true);
        $this->assertTrue(self::$service->isHttps());
        $this->assertEquals(self::$service->getUrl(), 'https://maps.googleapis.com/maps/api/geocode');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$service->setHttps('foo');
        
        self::$service->setHttps(false);
    }
    
    /**
     * Checks the format getter & setter
     */
    public function testFormat()
    {
        self::$service->setFormat('xml');
        $this->assertEquals(self::$service->getFormat(), 'xml');
        
        self::$service->setFormat('json');
        $this->assertEquals(self::$service->getFormat(), 'json');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$service->setFormat('foo');
    }
}
