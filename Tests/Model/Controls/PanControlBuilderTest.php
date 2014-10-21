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
use Ivory\GoogleMapBundle\Model\Controls\PanControlBuilder;

/**
 * Pan control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\PanControlBuilder */
    protected $panControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControlBuilder = new PanControlBuilder('Ivory\GoogleMap\Controls\PanControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Controls\PanControl', $this->panControlBuilder->getClass());
        $this->assertNull($this->panControlBuilder->getControlPosition());
    }

    public function testSingleBuildWithoutValues()
    {
        $panControl = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::TOP_LEFT, $panControl->getControlPosition());
    }

    public function testSingleBuildWithValues()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->panControlBuilder->getControlPosition());

        $panControl = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl->getControlPosition());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $panControl1 = $this->panControlBuilder->build();
        $panControl2 = $this->panControlBuilder->build();

        $this->assertNotSame($panControl1, $panControl2);
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl1->getControlPosition());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl2->getControlPosition());
    }

    public function testMultipleBuildWithReset()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $panControl1 = $this->panControlBuilder->build();
        $this->panControlBuilder->reset();
        $panControl2 = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl1->getControlPosition());
        $this->assertSame(ControlPosition::TOP_LEFT, $panControl2->getControlPosition());
    }
}
