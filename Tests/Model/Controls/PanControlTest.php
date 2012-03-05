<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\PanControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Pan control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\PanControl Tested pan control
     */
    protected static $panControl = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$panControl = new PanControl();
    }

    /**
     * Checks the pan control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$panControl->getControlPosition(), 'top_left');
    }

    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$panControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$panControl->getControlPosition(), 'bottom_center');

        $this->setExpectedException('InvalidArgumentException');
        self::$panControl->setControlPosition('foo');
    }
}
