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
        try
        {
            $mapTypeControlStyleTest = new MapTypeControlStyle();
            $this->fail('The class "\Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle" can not be instanciated.');
        }
        catch(\Exception $e){}
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
