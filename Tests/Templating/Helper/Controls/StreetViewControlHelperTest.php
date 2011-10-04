<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\StreetViewControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Model\Controls\StreetViewControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Street view control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\StreetViewControlHelper
     */
    protected static $streetViewControlHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$streetViewControlHelper = new StreetViewControlHelper(new ControlPositionHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $streetViewControl = new StreetViewControl();
        $streetViewControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$streetViewControlHelper->render($streetViewControl), '{"position":google.maps.ControlPosition.BOTTOM_CENTER}');
    }
}
