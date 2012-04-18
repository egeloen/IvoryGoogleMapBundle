<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Coordinate test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Tested coordinate
     */
    protected static $coordinate = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$coordinate = new Coordinate();
    }

    /**
     * Checks the coordinate default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$coordinate->getLatitude(), 0);
        $this->assertEquals(self::$coordinate->getLongitude(), 0);
        $this->assertTrue(self::$coordinate->isNoWrap());
    }

    /**
     * Checks the latitude getter & setter with null value
     */
    public function testLatitudeWithNullValue()
    {
        self::$coordinate->setLatitude(null);
        $this->assertNull(self::$coordinate->getLatitude());
    }

    /**
     * Checks the longitude getter & setter with null value
     */
    public function testLongitudeWithNullValue()
    {
        self::$coordinate->setLongitude(null);
        $this->assertNull(self::$coordinate->getLongitude());
    }

    /**
     * Checks the no wrap getter & setter with null value
     */
    public function testNoWrapWithNullValue()
    {
        self::$coordinate->setNoWrap(null);
        $this->assertNull(self::$coordinate->isNoWrap());
    }

    /**
     * Checks the latitude getter & setter
     */
    public function testLatitude()
    {
        self::$coordinate->setLatitude(1.1);
        $this->assertEquals(self::$coordinate->getLatitude(), 1.1);

        $this->setExpectedException('InvalidArgumentException');
        self::$coordinate->setLatitude('foo');
    }

    /**
     * Checks the longitude getter & setter
     */
    public function testLongitude()
    {
        self::$coordinate->setLongitude(1.1);
        $this->assertEquals(self::$coordinate->getLongitude(), 1.1);

        $this->setExpectedException('InvalidArgumentException');
        self::$coordinate->setLongitude('foo');
    }

    /**
     * Checks the no wrap getter & setter
     */
    public function testNoWrap()
    {
        self::$coordinate->setNoWrap(false);
        $this->assertFalse(self::$coordinate->isNoWrap());

        $this->setExpectedException('InvalidArgumentException');
        self::$coordinate->setLongitude('foo');
    }
}
