<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Control position test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constuctor
     */
    public function testConstruct()
    {
        $this->setExpectedException('Exception');
        $controlPositionTest = new ControlPosition();
    }
    
    /**
     * Checks the map type ids getter
     */
    public function testControlPositions()
    {
        $this->assertEquals(ControlPosition::getControlPositions(), array(
            ControlPosition::BOTTOM_CENTER,
            ControlPosition::BOTTOM_LEFT,
            ControlPosition::BOTTOM_RIGHT,
            ControlPosition::LEFT_BOTTOM,
            ControlPosition::LEFT_CENTER,
            ControlPosition::LEFT_TOP,
            ControlPosition::RIGHT_BOTTOM,
            ControlPosition::RIGHT_CENTER,
            ControlPosition::RIGHT_TOP,
            ControlPosition::TOP_CENTER,
            ControlPosition::TOP_LEFT,
            ControlPosition::TOP_RIGHT
        ));
    }
}
