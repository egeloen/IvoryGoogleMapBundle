<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractJavascriptVariableAssetTest;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Bound test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound Tested bound
     */
    protected static $bound = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$bound = new Bound();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$bound->getJavascriptVariable(), 0, 6), 'bound_');
    }

    /**
     * Checks the bound default value
     */
    public function testDefaultValues()
    {
        $this->assertFalse(self::$bound->hasCoordinates());
        $this->assertNull(self::$bound->getNorthEast());
        $this->assertNull(self::$bound->getSouthWest());
        $this->assertFalse(self::$bound->hasExtends());
        $this->assertEquals(count(self::$bound->getExtends()), 0);
    }

    /**
     * Checks the north east getter & setter
     */
    public function testNorthEast()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$bound->setNorthEast($coordinateTest);
        $this->assertEquals(self::$bound->getNorthEast()->getLatitude(), 1.1);
        $this->assertEquals(self::$bound->getNorthEast()->getLongitude(), 1.1);
        $this->assertTrue(self::$bound->getNorthEast()->isNoWrap());

        self::$bound->setNorthEast(2.1, 2.1, false);
        $this->assertEquals(self::$bound->getNorthEast()->getLatitude(), 2.1);
        $this->assertEquals(self::$bound->getNorthEast()->getLongitude(), 2.1);
        $this->assertFalse(self::$bound->getNorthEast()->isNoWrap());

        self::$bound->setNorthEast(null);
        $this->assertNull(self::$bound->getNorthEast());

        $this->setExpectedException('InvalidArgumentException');
        self::$bound->setNorthEast('foo');
    }

    /**
     * Checks the south west getter & setter
     */
    public function testSouthWest()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$bound->setSouthWest($coordinateTest);
        $this->assertEquals(self::$bound->getSouthWest()->getLatitude(), 1.1);
        $this->assertEquals(self::$bound->getSouthWest()->getLongitude(), 1.1);
        $this->assertTrue(self::$bound->getSouthWest()->isNoWrap());

        self::$bound->setSouthWest(2.1, 2.1, false);
        $this->assertEquals(self::$bound->getSouthWest()->getLatitude(), 2.1);
        $this->assertEquals(self::$bound->getSouthWest()->getLongitude(), 2.1);
        $this->assertFalse(self::$bound->getSouthWest()->isNoWrap());

        self::$bound->setSouthWest(null);
        $this->assertNull(self::$bound->getSouthWest());

        $this->setExpectedException('InvalidArgumentException');
        self::$bound->setSouthWest('foo');
    }

    /**
     * Checks the extend methods
     */
    public function testExtend()
    {
        $extendsTest = array(
            new Overlays\Circle(),
            new Overlays\GroundOverlay(),
            new Overlays\InfoWindow(),
            new Overlays\Marker(),
            new Overlays\Polygon(),
            new Overlays\Polyline(),
            new Overlays\Rectangle
        );

        self::$bound->setExtends($extendsTest);
        $this->assertEquals(count(self::$bound->getExtends()), 7);
    }

    /**
     * Checks getCenter method
     */
    public function testCenter()
    {
        self::$bound->setNorthEast(new Coordinate(1, 1));
        self::$bound->setSouthWest(new Coordinate(-1, -1));
        $this->assertEquals(0, self::$bound->getCenter()->getLatitude());
        $this->assertEquals(0, self::$bound->getCenter()->getLongitude());

        self::$bound->setNorthEast(new Coordinate(1, 1));
        self::$bound->setSouthWest(new Coordinate(1, 0));
        $this->assertEquals(1, self::$bound->getCenter()->getLatitude());
        $this->assertEquals(0.5, self::$bound->getCenter()->getLongitude());
    }
}
