<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\RectangleHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\Rectangle;
use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Rectangle helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\RectangleHelper
     */
    protected static $rectangleHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$rectangleHelper = new RectangleHelper(new BoundHelper(new CoordinateHelper()));
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        
        $rectangleTest = new Rectangle();
        $boundTest = new Bound();
        $boundTest->setSouthWest(new Coordinate(-1.1, -2.1, true));
        $boundTest->setNorthEast(new Coordinate(1.1, 2.1, true));
        $rectangleTest->setBound($boundTest);
        
        $this->assertEquals(self::$rectangleHelper->render($rectangleTest, $mapTest), 
            'var '.$rectangleTest->getBound()->getJavascriptVariable().' = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL.
            'var '.$rectangleTest->getJavascriptVariable().' = new google.maps.Rectangle({"map":'.$mapTest->getJavascriptVariable().',"bounds":'.$rectangleTest->getBound()->getJavascriptVariable().'});'.PHP_EOL
        );
        
        $rectangleTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$rectangleHelper->render($rectangleTest, $mapTest), 
            'var '.$rectangleTest->getBound()->getJavascriptVariable().' = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL.
            'var '.$rectangleTest->getJavascriptVariable().' = new google.maps.Rectangle({"map":'.$mapTest->getJavascriptVariable().',"bounds":'.$rectangleTest->getBound()->getJavascriptVariable().',"option1":"value1","option2":"value2"});'.PHP_EOL
        );
    }
}
