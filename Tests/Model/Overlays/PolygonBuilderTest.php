<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Overlays\PolygonBuilder;

/**
 * Polygon builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\PolygonBuilder */
    protected $polygonBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygonBuilder = new PolygonBuilder('Ivory\GoogleMap\Overlays\Polygon');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygonBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\Polygon', $this->polygonBuilder->getClass());
        $this->assertNull($this->polygonBuilder->getPrefixJavascriptVariable());
        $this->assertEmpty($this->polygonBuilder->getCoordinates());
        $this->assertEmpty($this->polygonBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $polygon = $this->polygonBuilder->build();

        $this->assertSame('polygon_', substr($polygon->getJavascriptVariable(), 0, 8));
        $this->assertEmpty($polygon->getCoordinates());
        $this->assertEmpty($polygon->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->polygonBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->polygonBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(array(1, 2, true), array(3, 4, false)), $this->polygonBuilder->getCoordinates());
        $this->assertSame(array('foo' => 'bar'), $this->polygonBuilder->getOptions());

        $polygon = $this->polygonBuilder->build();

        $this->assertSame('foo', substr($polygon->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polygon->getOptions());

        $coordinates = $polygon->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates);
        $this->assertSame(1, $coordinates[0]->getLatitude());
        $this->assertSame(2, $coordinates[0]->getLongitude());
        $this->assertTrue($coordinates[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates);
        $this->assertSame(3, $coordinates[1]->getLatitude());
        $this->assertSame(4, $coordinates[1]->getLongitude());
        $this->assertFalse($coordinates[1]->isNoWrap());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->polygonBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $polygon1 = $this->polygonBuilder->build();
        $polygon2 = $this->polygonBuilder->build();

        $this->assertNotSame($polygon1, $polygon2);

        $this->assertSame('foo', substr($polygon1->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polygon1->getOptions());

        $coordinates1 = $polygon1->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates1);
        $this->assertSame(1, $coordinates1[0]->getLatitude());
        $this->assertSame(2, $coordinates1[0]->getLongitude());
        $this->assertTrue($coordinates1[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates1);
        $this->assertSame(3, $coordinates1[1]->getLatitude());
        $this->assertSame(4, $coordinates1[1]->getLongitude());
        $this->assertFalse($coordinates1[1]->isNoWrap());

        $this->assertSame('foo', substr($polygon2->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polygon2->getOptions());

        $coordinates2 = $polygon2->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates2);
        $this->assertSame(1, $coordinates2[0]->getLatitude());
        $this->assertSame(2, $coordinates2[0]->getLongitude());
        $this->assertTrue($coordinates2[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates2);
        $this->assertSame(3, $coordinates2[1]->getLatitude());
        $this->assertSame(4, $coordinates2[1]->getLongitude());
        $this->assertFalse($coordinates2[1]->isNoWrap());
    }

    public function testMultipleBuildWithReset()
    {
        $this->polygonBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $polygon1 = $this->polygonBuilder->build();
        $this->polygonBuilder->reset();
        $polygon2 = $this->polygonBuilder->build();

        $this->assertSame('foo', substr($polygon1->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polygon1->getOptions());

        $coordinates1 = $polygon1->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates1);
        $this->assertSame(1, $coordinates1[0]->getLatitude());
        $this->assertSame(2, $coordinates1[0]->getLongitude());
        $this->assertTrue($coordinates1[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates1);
        $this->assertSame(3, $coordinates1[1]->getLatitude());
        $this->assertSame(4, $coordinates1[1]->getLongitude());
        $this->assertFalse($coordinates1[1]->isNoWrap());

        $this->assertSame('polygon_', substr($polygon2->getJavascriptVariable(), 0, 8));
        $this->assertEmpty($polygon2->getCoordinates());
        $this->assertEmpty($polygon2->getOptions());
    }
}
