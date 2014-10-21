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

use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder;

/**
 * Ground overlay builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder */
    protected $groundOverlayBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundBuilder = new BoundBuilder(
            'Ivory\GoogleMap\Base\Bound',
            new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate')
        );

        $this->groundOverlayBuilder = new GroundOverlayBuilder(
            'Ivory\GoogleMap\Overlays\GroundOverlay',
            $this->boundBuilder
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->groundOverlayBuilder);
        unset($this->boundBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\GroundOverlay', $this->groundOverlayBuilder->getClass());
        $this->assertSame($this->boundBuilder, $this->groundOverlayBuilder->getBoundBuilder());
        $this->assertNull($this->groundOverlayBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->groundOverlayBuilder->getUrl());
        $this->assertEmpty($this->groundOverlayBuilder->getBound());
        $this->assertEmpty($this->groundOverlayBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $groundOverlay = $this->groundOverlayBuilder->build();

        $this->assertSame('ground_overlay_', substr($groundOverlay->getJavascriptVariable(), 0, 15));
        $this->assertNull($groundOverlay->getUrl());

        $this->assertSame(-1, $groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $groundOverlay->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(1, $groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $groundOverlay->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getNorthEast()->isNoWrap());

        $this->assertEmpty($groundOverlay->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->groundOverlayBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setBound(-2, -3, 2, 3, true, false)
            ->setOptions(array('foo' => 'bar'));

        $groundOverlay = $this->groundOverlayBuilder->build();

        $this->assertSame('foo', substr($groundOverlay->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $groundOverlay->getUrl());

        $this->assertSame(-2, $groundOverlay->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-3, $groundOverlay->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(2, $groundOverlay->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(3, $groundOverlay->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($groundOverlay->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $groundOverlay->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->groundOverlayBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setBound(-2, -3, 2, 3, true, false)
            ->setOptions(array('foo' => 'bar'));

        $groundOverlay1 = $this->groundOverlayBuilder->build();
        $groundOverlay2 = $this->groundOverlayBuilder->build();

        $this->assertNotSame($groundOverlay1, $groundOverlay2);

        $this->assertSame('foo', substr($groundOverlay1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $groundOverlay1->getUrl());

        $this->assertSame(-2, $groundOverlay1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-3, $groundOverlay1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(2, $groundOverlay1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(3, $groundOverlay1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($groundOverlay1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $groundOverlay1->getOptions());

        $this->assertSame('foo', substr($groundOverlay2->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $groundOverlay2->getUrl());

        $this->assertSame(-2, $groundOverlay2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-3, $groundOverlay2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(2, $groundOverlay2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(3, $groundOverlay2->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($groundOverlay2->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $groundOverlay2->getOptions());
    }
    public function testMultipleBuildWithReset()
    {
        $this->groundOverlayBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setBound(-2, -3, 2, 3, true, false)
            ->setOptions(array('foo' => 'bar'));

        $groundOverlay1 = $this->groundOverlayBuilder->build();
        $this->groundOverlayBuilder->reset();
        $groundOverlay2 = $this->groundOverlayBuilder->build();

        $this->assertSame('foo', substr($groundOverlay1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $groundOverlay1->getUrl());

        $this->assertSame(-2, $groundOverlay1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-3, $groundOverlay1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(2, $groundOverlay1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(3, $groundOverlay1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($groundOverlay1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $groundOverlay1->getOptions());

        $this->assertSame('ground_overlay_', substr($groundOverlay2->getJavascriptVariable(), 0, 15));
        $this->assertNull($groundOverlay2->getUrl());

        $this->assertSame(-1, $groundOverlay2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $groundOverlay2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($groundOverlay2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(1, $groundOverlay2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $groundOverlay2->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($groundOverlay2->getBound()->getNorthEast()->isNoWrap());

        $this->assertEmpty($groundOverlay2->getOptions());
    }
}
