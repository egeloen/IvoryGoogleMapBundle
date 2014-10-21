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
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMapBundle\Model\Controls\ScaleControlBuilder;

/**
 * Scale control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\ScaleControlBuilder */
    protected $scaleControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlBuilder = new ScaleControlBuilder('Ivory\GoogleMap\Controls\ScaleControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Controls\ScaleControl', $this->scaleControlBuilder->getClass());
        $this->assertNull($this->scaleControlBuilder->getControlPosition());
    }

    public function testSingleBuildWithoutValues()
    {
        $scaleControl = $this->scaleControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_LEFT, $scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl->getScaleControlStyle());
    }

    public function testSingleBuildWithValues()
    {
        $this->scaleControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setScaleControlStyle(ScaleControlStyle::DEFAULT_);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->scaleControlBuilder->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->scaleControlBuilder->getScaleControlStyle());

        $scaleControl = $this->scaleControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl->getScaleControlStyle());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->scaleControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setScaleControlStyle(ScaleControlStyle::DEFAULT_);

        $scaleControl1 = $this->scaleControlBuilder->build();
        $scaleControl2 = $this->scaleControlBuilder->build();

        $this->assertNotSame($scaleControl1, $scaleControl2);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $scaleControl1->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl1->getScaleControlStyle());

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $scaleControl2->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl2->getScaleControlStyle());
    }

    public function testMultipleBuildWithReset()
    {
        $this->scaleControlBuilder
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setScaleControlStyle(ScaleControlStyle::DEFAULT_);

        $scaleControl1 = $this->scaleControlBuilder->build();
        $this->scaleControlBuilder->reset();
        $scaleControl2 = $this->scaleControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $scaleControl1->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl1->getScaleControlStyle());

        $this->assertSame(ControlPosition::BOTTOM_LEFT, $scaleControl2->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl2->getScaleControlStyle());
    }
}
