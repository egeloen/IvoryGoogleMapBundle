<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Geocoder;

/**
 * Geocoder test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\Geocoder $geocoder Geocoder testes
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
     * Checks the geocode method
     * 
     * @todo Finish implementation
     */
    public function testGeocode()
    {
        
    }
    
    /**
     * Checks the reverse method
     * 
     * @todo Finish implementation
     */
    public function testReverse()
    {
        
    }
}
