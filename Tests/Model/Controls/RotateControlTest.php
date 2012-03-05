<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\RotateControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Rotate control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\RotateControl Tested rotate control
     */
    protected static $rotateControl = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$rotateControl = new RotateControl();
    }

    /**
     * Checks the rotate control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$rotateControl->getControlPosition(), 'top_left');
    }

    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$rotateControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$rotateControl->getControlPosition(), 'bottom_center');

        $this->setExpectedException('InvalidArgumentException');
        self::$rotateControl->setControlPosition('foo');
    }
}
