<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\ScaleControl Tested scale control
     */
    protected static $scaleControl = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$scaleControl = new ScaleControl();
    }

    /**
     * Checks the map type control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$scaleControl->getControlPosition(), 'bottom_left');
        $this->assertEquals(self::$scaleControl->getScaleControlStyle(), 'default');
    }

    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$scaleControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$scaleControl->getControlPosition(), 'bottom_center');

        $this->setExpectedException('InvalidArgumentException');
        self::$scaleControl->setControlPosition('foo');
    }

    /**
     * Checks the scale control style getter & setter
     */
    public function testScaleControlStyle()
    {
        self::$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
        $this->assertEquals(self::$scaleControl->getScaleControlStyle(), 'default');

        $this->setExpectedException('InvalidArgumentException');
        self::$scaleControl->setScaleControlStyle('foo');
    }
}
