<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\RotateControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Model\Controls\RotateControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Rotate control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\RotateControlHelper
     */
    protected static $rotateControlHelper = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$rotateControlHelper = new RotateControlHelper(new ControlPositionHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $rotateControl = new RotateControl();
        $rotateControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$rotateControlHelper->render($rotateControl), '{"position":google.maps.ControlPosition.BOTTOM_CENTER}');
    }
}
