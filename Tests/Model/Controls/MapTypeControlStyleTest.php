<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control style test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        $this->setExpectedException('Exception');
        $mapTypeControlStyleTest = new MapTypeControlStyle();
    }
    
    /**
     * Checks the map type control styles getter
     */
    public function testMapTypeControlStyles()
    {
        $this->assertEquals(MapTypeControlStyle::getMapTypeControlStyles(), array(
            MapTypeControlStyle::DEFAULT_,
            MapTypeControlStyle::DROPDOWN_MENU,
            MapTypeControlStyle::HORIZONTAL_BAR
        ));
    }
}
