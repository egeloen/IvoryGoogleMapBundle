<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\PanControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Model\Controls\PanControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Overview map control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\PanControlHelper
     */
    protected static $panControlHelper = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$panControlHelper = new PanControlHelper(new ControlPositionHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $panControl = new PanControl();
        $panControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$panControlHelper->render($panControl), '{"position":google.maps.ControlPosition.BOTTOM_CENTER}');
    }
}
