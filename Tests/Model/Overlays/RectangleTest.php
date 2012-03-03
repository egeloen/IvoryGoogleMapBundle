<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\Rectangle;
use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Rectangle test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleTest extends AbstractOptionsAssetTest
{
    /**
     * @override
     */
    protected function setUp()
    {
        self::$object = new Rectangle();
    }

    /**
     * @override
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 10), 'rectangle_');
    }

    /**
     * @override
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();

        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$object->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue(self::$object->getBound()->getSouthWest()->isNoWrap());
    }

    /**
     * Checks the bound getter & setter
     */
    public function testBound()
    {
        $boundTest = new Bound();
        $boundTest->setSouthWest(new Coordinate(-1, -1, true));
        $boundTest->setNorthEast(new Coordinate(1, 1, true));
        self::$object->setBound($boundTest);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue(self::$object->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue(self::$object->getBound()->getNorthEast()->isNoWrap());

        $southWestTest = new Coordinate(-2.1, -2.1, false);
        $northEastTest = new Coordinate(2.1, 2.1, false);
        self::$object->setBound($southWestTest, $northEastTest);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLatitude(), -2.1);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLongitude(), -2.1);
        $this->assertFalse(self::$object->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLatitude(), 2.1);
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLongitude(), 2.1);
        $this->assertFalse(self::$object->getBound()->getNorthEast()->isNoWrap());

        self::$object->setBound(-3.1, -3.1, 3.1, 3.1, true, false);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLatitude(), -3.1);
        $this->assertEquals(self::$object->getBound()->getSouthWest()->getLongitude(), -3.1);
        $this->assertTrue(self::$object->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLatitude(), 3.1);
        $this->assertEquals(self::$object->getBound()->getNorthEast()->getLongitude(), 3.1);
        $this->assertFalse(self::$object->getBound()->getNorthEast()->isNoWrap());

        $boundTest = new Bound();
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setBound($boundTest);

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setBound('foo');
    }
}
