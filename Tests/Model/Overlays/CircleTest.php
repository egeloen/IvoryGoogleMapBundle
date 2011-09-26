<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Overlays\Circle;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Circle test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\Circle Tested circle
     */
    protected static $circle = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$circle = new Circle();
    }
    
    /**
     * Checks the circle default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(substr(self::$circle->getJavascriptVariable(), 0, 7), 'circle_');
        $this->assertEquals(self::$circle->getCenter()->getLatitude(), 0);
        $this->assertEquals(self::$circle->getCenter()->getLongitude(), 0);
        $this->assertTrue(self::$circle->getCenter()->isNoWrap());
        $this->assertEquals(self::$circle->getRadius(), 1);
        $this->assertEquals(count(self::$circle->getOptions()), 0);
    }
    
    /**
     * Checks the center getter & setter
     */
    public function testCenter()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$circle->setCenter($coordinateTest);
        $this->assertEquals(self::$circle->getCenter()->getLatitude(), 1.1);
        $this->assertEquals(self::$circle->getCenter()->getLongitude(), 1.1);
        $this->assertTrue(self::$circle->getCenter()->isNoWrap());
        
        self::$circle->setCenter(2.1, 2.1, false);
        $this->assertEquals(self::$circle->getCenter()->getLatitude(), 2.1);
        $this->assertEquals(self::$circle->getCenter()->getLongitude(), 2.1);
        $this->assertFalse(self::$circle->getCenter()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$circle->setCenter('foo');
    }
    
    /**
     * Checks the radius getter & setter
     */
    public function testRadius()
    {
        self::$circle->setRadius(2.1);
        $this->assertEquals(self::$circle->getRadius(), 2.1);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$circle->setRadius('foo');
    }
    
    /**
     * Checks the options getter & setter
     */
    public function testOptions()
    {
        $validOptionsTest = array(
            'option1' => 'value1',
            'option2' => 'value2'
        );
        
        self::$circle->setOptions($validOptionsTest);
        $this->assertEquals(count(self::$circle->getOptions()), 2);
        
        $invalidOptionsTest = array(
            0 => 'value1',
            1 => 'value2'
        );
        
        $this->setExpectedException('InvalidArgumentException');
        self::$circle->setOptions($invalidOptionsTest);
        
        $this->assertEquals(self::$circle->getOption('option1'), 'value1');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$circle->getOption(0);
    }
}
