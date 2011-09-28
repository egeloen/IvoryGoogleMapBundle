<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\Base\PointHelper;
use Ivory\GoogleMapBundle\Model\Base\Point;

/**
 * Point helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\PointHelper
     */
    protected static $pointHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$pointHelper = new PointHelper();
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $pointTest = new Point(1.1, 2.1);
        $this->assertEquals(self::$pointHelper->render($pointTest), 'new google.maps.Point(1.1, 2.1)');
    }
}
