<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding\Result;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResult;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderAddressComponent;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderGeometry;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderLocationType;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * GeocoderResult test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResult
     */
    protected static $geocoderResult = null;

    /**
     * @override
     */
    public function setUp()
    {
        $addressComponentsTest = array(
            new GeocoderAddressComponent('long_name_1', 'short_name_1', array('type_1', 'type_2')),
            new GeocoderAddressComponent('long_name_2', 'short_name_2', array('type_3', 'type_4'))
        );

        $viewportTest = new Bound();
        $viewportTest->setSouthWest(-1.1, -2.1, true);
        $viewportTest->setNorthEast(2.1, 1.1, true);

        $boundTest = new Bound();
        $boundTest->setSouthWest(-5.1, -4.1, true);
        $boundTest->setNorthEast(4.1, 5.1, true);

        $geometryTest = new GeocoderGeometry(new Coordinate(1.2, 2.1, true), GeocoderLocationType::APPROXIMATE, $viewportTest, $boundTest);

        self::$geocoderResult = new GeocoderResult($addressComponentsTest, 'address', $geometryTest, array('type_1', 'type_2'), true);
    }

    /**
     * Checks the geocoder result default values
     */
    public function testDefaultValues()
    {
        $addressComponents = self::$geocoderResult->getAddressComponents();
        $this->assertEquals($addressComponents[0]->getLongName(), 'long_name_1');
        $this->assertEquals($addressComponents[0]->getShortName(), 'short_name_1');
        $this->assertEquals($addressComponents[0]->getTypes(), array('type_1', 'type_2'));
        $this->assertEquals($addressComponents[1]->getLongName(), 'long_name_2');
        $this->assertEquals($addressComponents[1]->getShortName(), 'short_name_2');
        $this->assertEquals($addressComponents[1]->getTypes(), array('type_3', 'type_4'));

        $this->assertEquals(self::$geocoderResult->getFormattedAddress(), 'address');

        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocation()->getLatitude(), 1.2);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocation()->getLongitude(), 2.1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getLocation()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocationType(), GeocoderLocationType::APPROXIMATE);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->getLatitude(), 2.1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->getLongitude(), 1.1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->getLatitude(), -5.1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->getLongitude(), -4.1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->getLatitude(), 4.1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->getLongitude(), 5.1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->isNoWrap());

        $this->assertTrue(self::$geocoderResult->isPartialMatch());
        $this->assertEquals(self::$geocoderResult->getTypes(), array('type_1', 'type_2'));
    }

    /**
     * Checks the address components getter & setter
     */
    public function testAddressComponents()
    {
        $addressComponentsTest = array(
            new GeocoderAddressComponent('longname1', 'shortname1', array('type1', 'type2')),
            new GeocoderAddressComponent('longname2', 'shortname2', array('type3', 'type4'))
        );

        self::$geocoderResult->setAddressComponents($addressComponentsTest);
        $addressComponents = self::$geocoderResult->getAddressComponents();
        $this->assertEquals($addressComponents[0]->getLongName(), 'longname1');
        $this->assertEquals($addressComponents[0]->getShortName(), 'shortname1');
        $this->assertEquals($addressComponents[0]->getTypes(), array('type1', 'type2'));
        $this->assertEquals($addressComponents[1]->getLongName(), 'longname2');
        $this->assertEquals($addressComponents[1]->getShortName(), 'shortname2');
        $this->assertEquals($addressComponents[1]->getTypes(), array('type3', 'type4'));

        self::$geocoderResult->addAddressComponent(new GeocoderAddressComponent('longname3', 'shortname3', array('type5', 'type6')));

        $addressComponents = self::$geocoderResult->getAddressComponents();
        $this->assertEquals($addressComponents[2]->getLongName(), 'longname3');
        $this->assertEquals($addressComponents[2]->getShortName(), 'shortname3');
        $this->assertEquals($addressComponents[2]->getTypes(), array('type5', 'type6'));
    }

    /**
     * Checks the formatted address getter & setter
     */
    public function testFormattedAddress()
    {
        self::$geocoderResult->setFormattedAddress('formatted_address');
        $this->assertEquals(self::$geocoderResult->getFormattedAddress(), 'formatted_address');

        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderResult->setFormattedAddress(true);
    }

    /**
     * Checks the geometry getter & setter
     */
    public function testGeometry()
    {
        $viewportTest = new Bound();
        $viewportTest->setSouthWest(-1, -2, true);
        $viewportTest->setNorthEast(2, 1, true);

        $boundTest = new Bound();
        $boundTest->setSouthWest(-5, -4, true);
        $boundTest->setNorthEast(4, 5, true);

        self::$geocoderResult->setGeometry(new GeocoderGeometry(new Coordinate(1, 2, true), GeocoderLocationType::APPROXIMATE, $viewportTest, $boundTest));

        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocation()->getLatitude(), 1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocation()->getLongitude(), 2);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getLocation()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getLocationType(), GeocoderLocationType::APPROXIMATE);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->getLongitude(), -2);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getViewport()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->getLatitude(), 2);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getViewport()->getNorthEast()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->getLatitude(), -5);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->getLongitude(), -4);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->getLatitude(), 4);
        $this->assertEquals(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->getLongitude(), 5);
        $this->assertTrue(self::$geocoderResult->getGeometry()->getBound()->getNorthEast()->isNoWrap());
    }

    /**
     * Checks the partial match getter & setter
     */
    public function testPartialMatch()
    {
        self::$geocoderResult->setPartialMatch(false);
        $this->assertFalse(self::$geocoderResult->isPartialMatch());

        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderResult->setPartialMatch('foo');
    }

    /**
     * Checks the types getter & setter
     */
    public function testTypes()
    {
        self::$geocoderResult->setTypes(array('type_1', 'type_2'));
        $this->assertEquals(self::$geocoderResult->getTypes(), array('type_1', 'type_2'));
    }
}
