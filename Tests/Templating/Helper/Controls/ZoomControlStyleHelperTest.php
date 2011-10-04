<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlStyleHelper;
use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * Zoom control style helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlStyleHelper
     */
    protected static $zoomControlStyleHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$zoomControlStyleHelper = new ZoomControlStyleHelper();
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$zoomControlStyleHelper->render(ZoomControlStyle::DEFAULT_), 'google.maps.ZoomControlStyle.DEFAULT');
        $this->assertEquals(self::$zoomControlStyleHelper->render(ZoomControlStyle::LARGE), 'google.maps.ZoomControlStyle.LARGE');
        $this->assertEquals(self::$zoomControlStyleHelper->render(ZoomControlStyle::SMALL), 'google.maps.ZoomControlStyle.SMALL');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$zoomControlStyleHelper->render('foo');
    }
}
