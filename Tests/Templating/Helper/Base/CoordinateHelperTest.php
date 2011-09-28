<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Coordinate helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected static $coordinateHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$coordinateHelper = new CoordinateHelper();
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $coordinateTest = new Coordinate(1.1, 2.1, true);
        $this->assertEquals(self::$coordinateHelper->render($coordinateTest), 'new google.maps.LatLng(1.1, 2.1, true)');
        
        $coordinateTest = new Coordinate(2.1, 1.1, false);
        $this->assertEquals(self::$coordinateHelper->render($coordinateTest), 'new google.maps.LatLng(2.1, 1.1, false)');
    }
}
