<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoder;

use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderResponse;
use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderResult;
use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderAddressComponent;
use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderGeometry;
use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderLocationType;
use Ivory\GoogleMapBundle\Model\Services\Geocoder\GeocoderStatus;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * GeocoderResponse test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\GeocoderResponse
     */
    protected static $geocoderResponse = null;
    
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
        
        $results = array(new GeocoderResult($addressComponentsTest, 'address', $geometryTest, true, array('type_1', 'type_2')));
        $status = GeocoderStatus::OK;
        
        self::$geocoderResponse = new GeocoderResponse($results, $status);
    }
    
    /**
     * Checks geocoder responde default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(count(self::$geocoderResponse->getResults()), 1);
        $this->assertEquals(self::$geocoderResponse->getStatus(), GeocoderStatus::OK);
    }
    
    /**
     * Checks the results getter & setter
     */
    public function testResults()
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
        
        self::$geocoderResponse->addResult(new GeocoderResult($addressComponentsTest, 'address', $geometryTest, true, array('type_1', 'type_2')));
        $this->assertEquals(count(self::$geocoderResponse->getResults()), 2);
    }
    
    /**
     * Checks the status getter & setter
     */
    public function testStatus()
    {
        self::$geocoderResponse->setStatus(GeocoderStatus::ERROR);
        $this->assertEquals(self::$geocoderResponse->getStatus(), GeocoderStatus::ERROR);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$geocoderResponse->setStatus('foo');
    }
}
