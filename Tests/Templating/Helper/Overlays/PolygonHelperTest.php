<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolygonHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\Polygon;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Polygon helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolygonHelper
     */
    protected static $polygonHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$polygonHelper = new PolygonHelper(new CoordinateHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        
        $polygonTest = new Polygon();
        $polygonTest->setCoordinates(array(
            new Coordinate(1.1, 2.1, true),
            new Coordinate(3.1, 4.2, true),
            new Coordinate(7.4, 12.6, true)
        ));
        
        $this->assertEquals(self::$polygonHelper->render($polygonTest, $mapTest), 'var '.$polygonTest->getJavascriptVariable().' = new google.maps.Polygon({"map":'.$mapTest->getJavascriptVariable().',"paths":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)]});'.PHP_EOL);
        
        $polygonTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$polygonHelper->render($polygonTest, $mapTest), 'var '.$polygonTest->getJavascriptVariable().' = new google.maps.Polygon({"map":'.$mapTest->getJavascriptVariable().',"paths":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)],"option1":"value1","option2":"value2"});'.PHP_EOL);
    }
}
