<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * Zoom control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\ZoomControl Tested zoom control
     */
    protected static $zoomControl = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$zoomControl = new ZoomControl();
    }

    /**
     * Checks the zoom control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$zoomControl->getControlPosition(), 'top_left');
        $this->assertEquals(self::$zoomControl->getZoomControlStyle(), 'default');
    }

    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$zoomControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$zoomControl->getControlPosition(), 'bottom_center');

        $this->setExpectedException('InvalidArgumentException');
        self::$zoomControl->setControlPosition('foo');
    }

    /**
     * Checks the zoom control style getter & setter
     */
    public function testZoomControlStyle()
    {
        self::$zoomControl->setZoomControlStyle(ZoomControlStyle::LARGE);
        $this->assertEquals(self::$zoomControl->getZoomControlStyle(), 'large');

        $this->setExpectedException('InvalidArgumentException');
        self::$zoomControl->setZoomControlStyle('foo');
    }
}
