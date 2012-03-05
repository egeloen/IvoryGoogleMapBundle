<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Control position helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected static $controlPositionHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$controlPositionHelper = new ControlPositionHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::BOTTOM_CENTER), 'google.maps.ControlPosition.BOTTOM_CENTER');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::BOTTOM_LEFT), 'google.maps.ControlPosition.BOTTOM_LEFT');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::BOTTOM_RIGHT), 'google.maps.ControlPosition.BOTTOM_RIGHT');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::LEFT_BOTTOM), 'google.maps.ControlPosition.LEFT_BOTTOM');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::LEFT_CENTER), 'google.maps.ControlPosition.LEFT_CENTER');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::LEFT_TOP), 'google.maps.ControlPosition.LEFT_TOP');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::RIGHT_BOTTOM), 'google.maps.ControlPosition.RIGHT_BOTTOM');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::RIGHT_CENTER), 'google.maps.ControlPosition.RIGHT_CENTER');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::RIGHT_TOP), 'google.maps.ControlPosition.RIGHT_TOP');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::TOP_CENTER), 'google.maps.ControlPosition.TOP_CENTER');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::TOP_LEFT), 'google.maps.ControlPosition.TOP_LEFT');
        $this->assertEquals(self::$controlPositionHelper->render(ControlPosition::TOP_RIGHT), 'google.maps.ControlPosition.TOP_RIGHT');

        $this->setExpectedException('InvalidArgumentException');
        self::$controlPositionHelper->render('foo');
    }
}
