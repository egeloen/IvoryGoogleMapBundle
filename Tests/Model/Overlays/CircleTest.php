<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\Circle;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Circle test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends AbstractOptionsAssetTest
{   
    /**
     * @override
     */
    protected function setUp()
    {
        self::$object = new Circle();
    }
    
    /**
     * @override
     */
    public function testJavascriptVariable() 
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 7), 'circle_');
    }
    
    /**
     * @override
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();
        
        $this->assertEquals(self::$object->getCenter()->getLatitude(), 0);
        $this->assertEquals(self::$object->getCenter()->getLongitude(), 0);
        $this->assertTrue(self::$object->getCenter()->isNoWrap());
        $this->assertEquals(self::$object->getRadius(), 1);
    }
    
    /**
     * Checks the center getter & setter
     */
    public function testCenter()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$object->setCenter($coordinateTest);
        $this->assertEquals(self::$object->getCenter()->getLatitude(), 1.1);
        $this->assertEquals(self::$object->getCenter()->getLongitude(), 1.1);
        $this->assertTrue(self::$object->getCenter()->isNoWrap());
        
        self::$object->setCenter(2.1, 2.1, false);
        $this->assertEquals(self::$object->getCenter()->getLatitude(), 2.1);
        $this->assertEquals(self::$object->getCenter()->getLongitude(), 2.1);
        $this->assertFalse(self::$object->getCenter()->isNoWrap());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setCenter('foo');
    }
    
    /**
     * Checks the radius getter & setter
     */
    public function testRadius()
    {
        self::$object->setRadius(2.1);
        $this->assertEquals(self::$object->getRadius(), 2.1);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setRadius('foo');
    }
}
