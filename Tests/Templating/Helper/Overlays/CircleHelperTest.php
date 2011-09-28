<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\Circle;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Circle helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper
     */
    protected static $circleHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$circleHelper = new CircleHelper(new CoordinateHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        $circleTest = new Circle();
        $circleTest->setCenter(new Coordinate(1.1, 2.1, true));
        $circleTest->setRadius(2);
        $circleTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$circleHelper->render($circleTest, $mapTest), 'var '.$circleTest->getJavascriptVariable().' = new google.maps.Circle({"map":'.$mapTest->getJavascriptVariable().',"center":new google.maps.LatLng(1.1, 2.1, true),"radius":2,"option1":"value1","option2":"value2"});'.PHP_EOL);
    }
}
