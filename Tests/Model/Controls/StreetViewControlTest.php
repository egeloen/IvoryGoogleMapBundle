<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\StreetViewControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Street view control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\StreetViewControl Tested street view control
     */
    protected static $streetViewControl = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$streetViewControl = new StreetViewControl();
    }

    /**
     * Checks the street view control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$streetViewControl->getControlPosition(), 'top_left');
    }

    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$streetViewControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$streetViewControl->getControlPosition(), 'bottom_center');

        $this->setExpectedException('InvalidArgumentException');
        self::$streetViewControl->setControlPosition('foo');
    }
}
