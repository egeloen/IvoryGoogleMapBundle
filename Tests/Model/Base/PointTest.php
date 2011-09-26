<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Model\Base\Point;

/**
 * Point test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Point Tested point
     */
    protected static $point = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$point = new Point();
    }
    
    /**
     * Checks the point default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$point->getX(), 0);
        $this->assertEquals(self::$point->getY(), 0);
    }
    
    /**
     * Checks the x getter & setter
     */
    public function testX()
    {
        self::$point->setX(1.1);
        $this->assertEquals(self::$point->getX(), 1.1);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$point->setX('foo');
    }
    
    /**
     * Checks the y getter & setter
     */
    public function testY()
    {
        self::$point->setY(1.1);
        $this->assertEquals(self::$point->getY(), 1.1);
        
        $this->setExpectedException('InvalidArgumentException');
        self::$point->setY('foo');
    }
}
