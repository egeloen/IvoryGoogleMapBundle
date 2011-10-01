<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControl;
use Ivory\GoogleMapBundle\Model\MapTypeId;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\MapTypeControl Tested map type control
     */
    protected static $mapTypeControl = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$mapTypeControl = new MapTypeControl();
    }
    
    /**
     * Checks the map type control default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$mapTypeControl->getMapTypeIds(), array('roadmap', 'satellite'));
        $this->assertEquals(self::$mapTypeControl->getControlPosition(), 'top_right');
        $this->assertEquals(self::$mapTypeControl->getMapTypeControlStyle(), 'default');
    }
    
    /**
     * Checks the map type ids getter & setter
     */
    public function testMapTypeIds()
    {
        self::$mapTypeControl->setMapTypeIds(array(MapTypeId::ROADMAP));
        $this->assertTrue(in_array('roadmap', self::$mapTypeControl->getMapTypeIds()));
        $this->assertEquals(count(self::$mapTypeControl->getMapTypeIds()), 1);
        
        self::$mapTypeControl->addMapTypeId(MapTypeId::SATELLITE);
        $this->assertTrue(in_array('satellite', self::$mapTypeControl->getMapTypeIds()));
        $this->assertEquals(count(self::$mapTypeControl->getMapTypeIds()), 2);
    }
    
    /**
     * Checks the control position getter & setter
     */
    public function testControlPosition()
    {
        self::$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $this->assertEquals(self::$mapTypeControl->getControlPosition(), 'bottom_center');
    }
    
    /**
     * Checks the map type control style getter & setter
     */
    public function testMapTypeControlStyle()
    {
        self::$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);
        $this->assertEquals(self::$mapTypeControl->getMapTypeControlStyle(), 'dropdown_menu');
    }
}
