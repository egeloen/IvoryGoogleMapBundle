<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlStyleHelper;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * Description of ZoomControlHelperTest
 *
 * @author gelo
 */
class ZoomControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlHelper Tested zoom control helper
     */
    protected static $zoomControlHelper;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$zoomControlHelper = new ZoomControlHelper(new ControlPositionHelper(), new ZoomControlStyleHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $zoomControlTest = new ZoomControl();
        $zoomControlTest->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $zoomControlTest->setZoomControlStyle(ZoomControlStyle::SMALL);
        
        $this->assertEquals(self::$zoomControlHelper->render($zoomControlTest), '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ZoomControlStyle.SMALL}');
    }
}
