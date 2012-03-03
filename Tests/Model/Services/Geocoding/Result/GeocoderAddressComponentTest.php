<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding\Result;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderAddressComponent;

/**
 * GeocoderAddressComponent test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderAddressComponent
     */
    protected static $geocoderAddressComponent = null;

    /**
     * @override
     */
    public function setUp()
    {
        self::$geocoderAddressComponent = new GeocoderAddressComponent('long_name', 'short_name', array('type_1', 'type_2'));
    }

    /**
     * Checks geocoder address component default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$geocoderAddressComponent->getLongName(), 'long_name');
        $this->assertEquals(self::$geocoderAddressComponent->getShortName(), 'short_name');
        $this->assertEquals(self::$geocoderAddressComponent->getTypes(), array('type_1', 'type_2'));
    }

    /**
     * Checks the long name getter & setter
     */
    public function testLongName()
    {
        self::$geocoderAddressComponent->setLongName('longname');
        $this->assertEquals(self::$geocoderAddressComponent->getLongName(), 'longname');

        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderAddressComponent->setLongName(true);
    }

    /**
     * Checks the short name getter & setter
     */
    public function testShortName()
    {
        self::$geocoderAddressComponent->setShortName('shortname');
        $this->assertEquals(self::$geocoderAddressComponent->getShortName(), 'shortname');

        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderAddressComponent->setShortName(true);
    }

    /**
     * Checks the types getter & setter
     */
    public function testTypes()
    {
        $typesTest = array('type1', 'type2');
        self::$geocoderAddressComponent->setTypes($typesTest);
        $this->assertEquals(self::$geocoderAddressComponent->getTypes(), array('type1', 'type2'));

        self::$geocoderAddressComponent->addType('type3');
        $this->assertEquals(self::$geocoderAddressComponent->getTypes(), array('type1', 'type2', 'type3'));

        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderAddressComponent->addType(true);
    }
}
