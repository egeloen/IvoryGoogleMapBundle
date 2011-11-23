<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Provider;
use Geocoder\HttpAdapter\BuzzHttpAdapter;

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
}
