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

use Ivory\GoogleMapBundle\Model\Overlays\PolylineBuilder;

/**
 * Polyline builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\PolylineBuilder */
    protected $polylineBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polylineBuilder = new PolylineBuilder('Ivory\GoogleMap\Overlays\Polyline');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->polylineBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\Polyline', $this->polylineBuilder->getClass());
        $this->assertNull($this->polylineBuilder->getPrefixJavascriptVariable());
        $this->assertEmpty($this->polylineBuilder->getCoordinates());
        $this->assertEmpty($this->polylineBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $polyline = $this->polylineBuilder->build();

        $this->assertSame('polyline_', substr($polyline->getJavascriptVariable(), 0, 9));
        $this->assertEmpty($polyline->getCoordinates());
        $this->assertEmpty($polyline->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->polylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->polylineBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(array(1, 2, true), array(3, 4, false)), $this->polylineBuilder->getCoordinates());
        $this->assertSame(array('foo' => 'bar'), $this->polylineBuilder->getOptions());

        $polyline = $this->polylineBuilder->build();

        $this->assertSame('foo', substr($polyline->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polyline->getOptions());

        $coordinates = $polyline->getCoordinates();

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
        $this->polylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $polyline1 = $this->polylineBuilder->build();
        $polyline2 = $this->polylineBuilder->build();

        $this->assertNotSame($polyline1, $polyline2);

        $this->assertSame('foo', substr($polyline1->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polyline1->getOptions());

        $coordinates1 = $polyline1->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates1);
        $this->assertSame(1, $coordinates1[0]->getLatitude());
        $this->assertSame(2, $coordinates1[0]->getLongitude());
        $this->assertTrue($coordinates1[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates1);
        $this->assertSame(3, $coordinates1[1]->getLatitude());
        $this->assertSame(4, $coordinates1[1]->getLongitude());
        $this->assertFalse($coordinates1[1]->isNoWrap());

        $this->assertSame('foo', substr($polyline2->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polyline2->getOptions());

        $coordinates2 = $polyline2->getCoordinates();

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
        $this->polylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->addCoordinate(1, 2)
            ->addCoordinate(3, 4, false)
            ->setOptions(array('foo' => 'bar'));

        $polyline1 = $this->polylineBuilder->build();
        $this->polylineBuilder->reset();
        $polyline2 = $this->polylineBuilder->build();

        $this->assertSame('foo', substr($polyline1->getJavascriptVariable(), 0, 3));
        $this->assertSame(array('foo' => 'bar'), $polyline1->getOptions());

        $coordinates1 = $polyline1->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates1);
        $this->assertSame(1, $coordinates1[0]->getLatitude());
        $this->assertSame(2, $coordinates1[0]->getLongitude());
        $this->assertTrue($coordinates1[0]->isNoWrap());

        $this->assertArrayHasKey(1, $coordinates1);
        $this->assertSame(3, $coordinates1[1]->getLatitude());
        $this->assertSame(4, $coordinates1[1]->getLongitude());
        $this->assertFalse($coordinates1[1]->isNoWrap());

        $this->assertSame('polyline_', substr($polyline2->getJavascriptVariable(), 0, 9));
        $this->assertEmpty($polyline2->getCoordinates());
        $this->assertEmpty($polyline2->getOptions());
    }
}
