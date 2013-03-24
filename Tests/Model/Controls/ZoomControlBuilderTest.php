<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMapBundle\Model\Controls\ZoomControlBuilder;

/**
 * Zoom control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\ZoomControlBuilder */
    protected $zoomControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlBuilder = new ZoomControlBuilder('Ivory\GoogleMap\Controls\ZoomControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Controls\ZoomControl', $this->zoomControlBuilder->getClass());
        $this->assertNull($this->zoomControlBuilder->getControlPosition());
        $this->assertNull($this->zoomControlBuilder->getZoomControlStyle());
    }

    public function testSingleBuildWithoutValues()
    {
        $zoomControl = $this->zoomControlBuilder->build();

        $this->assertSame(ControlPosition::TOP_LEFT, $zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $zoomControl->getZoomControlStyle());
    }

    public function testSingleBuildWithValues()
    {
        $this->zoomControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setZoomControlStyle(ZoomControlStyle::LARGE);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->zoomControlBuilder->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $this->zoomControlBuilder->getZoomControlStyle());

        $zoomControl = $this->zoomControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $zoomControl->getZoomControlStyle());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->zoomControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setZoomControlStyle(ZoomControlStyle::LARGE);

        $zoomControl1 = $this->zoomControlBuilder->build();
        $zoomControl2 = $this->zoomControlBuilder->build();

        $this->assertNotSame($zoomControl1, $zoomControl2);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $zoomControl1->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $zoomControl1->getZoomControlStyle());

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $zoomControl2->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $zoomControl2->getZoomControlStyle());
    }

    public function testMultipleBuildWithReset()
    {
        $this->zoomControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setZoomControlStyle(ZoomControlStyle::LARGE);

        $zoomControl1 = $this->zoomControlBuilder->build();
        $this->zoomControlBuilder->reset();
        $zoomControl2 = $this->zoomControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $zoomControl1->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $zoomControl1->getZoomControlStyle());

        $this->assertSame(ControlPosition::TOP_LEFT, $zoomControl2->getControlPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $zoomControl2->getZoomControlStyle());
    }
}
