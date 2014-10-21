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

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerBuilder;

/**
 * Marker builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\MarkerBuilder */
    protected $markerBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate');
        $this->markerBuilder = new MarkerBuilder('Ivory\GoogleMap\Overlays\Marker', $this->coordinateBuilder);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerBuilder);
        unset($this->coordinateBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\Marker', $this->markerBuilder->getClass());
        $this->assertSame($this->coordinateBuilder, $this->markerBuilder->getCoordinateBuilder());
        $this->assertNull($this->markerBuilder->getPrefixJavascriptVariable());
        $this->assertEmpty($this->markerBuilder->getPosition());
        $this->assertNull($this->markerBuilder->getAnimation());
        $this->assertEmpty($this->markerBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $marker = $this->markerBuilder->build();

        $this->assertSame('marker_', substr($marker->getJavascriptVariable(), 0, 7));

        $this->assertSame(0, $marker->getPosition()->getLatitude());
        $this->assertSame(0, $marker->getPosition()->getLongitude());
        $this->assertTrue($marker->getPosition()->isNoWrap());

        $this->assertNull($marker->getAnimation());
        $this->assertEmpty($marker->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->markerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setPosition(1, 2, false)
            ->setAnimation(Animation::BOUNCE)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->markerBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(1, 2, false), $this->markerBuilder->getPosition());
        $this->assertSame(Animation::BOUNCE, $this->markerBuilder->getAnimation());
        $this->assertSame(array('foo' => 'bar'), $this->markerBuilder->getOptions());

        $marker = $this->markerBuilder->build();

        $this->assertSame('foo', substr($marker->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $marker->getPosition()->getLatitude());
        $this->assertSame(2, $marker->getPosition()->getLongitude());
        $this->assertFalse($marker->getPosition()->isNoWrap());

        $this->assertSame(Animation::BOUNCE, $marker->getAnimation());
        $this->assertSame(array('foo' => 'bar'), $marker->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->markerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setPosition(1, 2, false)
            ->setAnimation(Animation::BOUNCE)
            ->setOptions(array('foo' => 'bar'));

        $marker1 = $this->markerBuilder->build();
        $marker2 = $this->markerBuilder->build();

        $this->assertNotSame($marker1, $marker2);

        $this->assertSame('foo', substr($marker1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $marker1->getPosition()->getLatitude());
        $this->assertSame(2, $marker1->getPosition()->getLongitude());
        $this->assertFalse($marker1->getPosition()->isNoWrap());

        $this->assertSame(Animation::BOUNCE, $marker1->getAnimation());
        $this->assertSame(array('foo' => 'bar'), $marker1->getOptions());

        $this->assertSame('foo', substr($marker2->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $marker2->getPosition()->getLatitude());
        $this->assertSame(2, $marker2->getPosition()->getLongitude());
        $this->assertFalse($marker2->getPosition()->isNoWrap());

        $this->assertSame(Animation::BOUNCE, $marker2->getAnimation());
        $this->assertSame(array('foo' => 'bar'), $marker2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->markerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setPosition(1, 2, false)
            ->setAnimation(Animation::BOUNCE)
            ->setOptions(array('foo' => 'bar'));

        $marker1 = $this->markerBuilder->build();
        $this->markerBuilder->reset();
        $marker2 = $this->markerBuilder->build();

        $this->assertNotSame($marker1, $marker2);

        $this->assertSame('foo', substr($marker1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $marker1->getPosition()->getLatitude());
        $this->assertSame(2, $marker1->getPosition()->getLongitude());
        $this->assertFalse($marker1->getPosition()->isNoWrap());

        $this->assertSame(Animation::BOUNCE, $marker1->getAnimation());
        $this->assertSame(array('foo' => 'bar'), $marker1->getOptions());

        $this->assertSame('marker_', substr($marker2->getJavascriptVariable(), 0, 7));

        $this->assertSame(0, $marker2->getPosition()->getLatitude());
        $this->assertSame(0, $marker2->getPosition()->getLongitude());
        $this->assertTrue($marker2->getPosition()->isNoWrap());

        $this->assertNull($marker2->getAnimation());
        $this->assertEmpty($marker2->getOptions());
    }
}
