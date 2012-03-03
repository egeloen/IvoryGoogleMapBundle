<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl;

/**
 * Overview map control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl Tested overview map control
     */
    protected static $overviewMapControl = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$overviewMapControl = new OverviewMapControl();
    }

    /**
     * Checks the map type control default value
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$overviewMapControl->isOpened());
    }

    /**
     * Checks the opened getter & setter
     */
    public function testOpened()
    {
        self::$overviewMapControl->setOpened(true);
        $this->assertTrue(self::$overviewMapControl->isOpened());

        $this->setExpectedException('InvalidArgumentException');
        self::$overviewMapControl->setOpened('foo');
    }
}
