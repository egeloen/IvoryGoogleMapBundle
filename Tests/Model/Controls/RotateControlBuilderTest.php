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
use Ivory\GoogleMapBundle\Model\Controls\RotateControlBuilder;

/**
 * Rotate control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\RotateControlBuilder */
    protected $rotateControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlBuilder = new RotateControlBuilder('Ivory\GoogleMap\Controls\RotateControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Controls\RotateControl', $this->rotateControlBuilder->getClass());
        $this->assertNull($this->rotateControlBuilder->getControlPosition());
    }

    public function testSingleBuildWithoutValues()
    {
        $rotateControl = $this->rotateControlBuilder->build();

        $this->assertSame(ControlPosition::TOP_LEFT, $rotateControl->getControlPosition());
    }

    public function testSingleBuildWithValues()
    {
        $this->rotateControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->rotateControlBuilder->getControlPosition());

        $rotateControl = $this->rotateControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $rotateControl->getControlPosition());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->rotateControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $rotateControl1 = $this->rotateControlBuilder->build();
        $rotateControl2 = $this->rotateControlBuilder->build();

        $this->assertNotSame($rotateControl1, $rotateControl2);
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $rotateControl1->getControlPosition());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $rotateControl2->getControlPosition());
    }

    public function testMultipleBuildWithReset()
    {
        $this->rotateControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $rotateControl1 = $this->rotateControlBuilder->build();
        $this->rotateControlBuilder->reset();
        $rotateControl2 = $this->rotateControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $rotateControl1->getControlPosition());
        $this->assertSame(ControlPosition::TOP_LEFT, $rotateControl2->getControlPosition());
    }
}
