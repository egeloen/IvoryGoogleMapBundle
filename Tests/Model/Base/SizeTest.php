<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Size test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Size Tested size
     */
    protected static $size = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$size = new Size();
    }

    /**
     * Checks the point default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$size->getWidth(), 1);
        $this->assertEquals(self::$size->getHeight(), 1);

        $this->assertNull(self::$size->getWidthUnit());
        $this->assertNull(self::$size->getHeightUnit());
    }

    /**
     * Checks the width getter & setter
     */
    public function testWidth()
    {
        self::$size->setWidth(1.1);
        $this->assertEquals(self::$size->getWidth(), 1.1);

        $this->setExpectedException('InvalidArgumentException');
        self::$size->setWidth('foo');
    }

    /**
     * Checks the height getter & setter
     */
    public function testHeight()
    {
        self::$size->setHeight(1.1);
        $this->assertEquals(self::$size->getHeight(), 1.1);

        $this->setExpectedException('InvalidArgumentException');
        self::$size->setHeight('foo');
    }

    /**
     * Checks the width unit getter & setter
     */
    public function testWidthUnit()
    {
        self::$size->setWidthUnit('px');
        $this->assertEquals(self::$size->getWidthUnit(), 'px');

        self::$size->setWidthUnit(null);
        $this->assertNull(self::$size->getWidthUnit());

        $this->setExpectedException('InvalidArgumentException');
        self::$size->setWidthUnit(1);
    }

    /**
     * Checks the height unit getter & setter
     */
    public function testHeightUnit()
    {
        self::$size->setHeightUnit('px');
        $this->assertEquals(self::$size->getHeightUnit(), 'px');

        self::$size->setHeightUnit(null);
        $this->assertNull(self::$size->getHeightUnit());

        $this->setExpectedException('InvalidArgumentException');
        self::$size->setHeightUnit(1);
    }
}
