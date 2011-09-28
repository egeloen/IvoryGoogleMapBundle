<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\Polyline;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Polyline helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper
     */
    protected static $polylineHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$polylineHelper = new PolylineHelper(new CoordinateHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        
        $polylineTest = new Polyline();
        $polylineTest->setCoordinates(array(
            new Coordinate(1.1, 2.1, true),
            new Coordinate(3.1, 4.2, true),
            new Coordinate(7.4, 12.6, true)
        ));
        
        $this->assertEquals(self::$polylineHelper->render($polylineTest, $mapTest), 'var '.$polylineTest->getJavascriptVariable().' = new google.maps.Polyline({"map":'.$mapTest->getJavascriptVariable().',"path":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)]});'.PHP_EOL);
        
        $polylineTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$polylineHelper->render($polylineTest, $mapTest), 'var '.$polylineTest->getJavascriptVariable().' = new google.maps.Polyline({"map":'.$mapTest->getJavascriptVariable().',"path":[new google.maps.LatLng(1.1, 2.1, true),new google.maps.LatLng(3.1, 4.2, true),new google.maps.LatLng(7.4, 12.6, true)],"option1":"value1","option2":"value2"});'.PHP_EOL);
    }
}
