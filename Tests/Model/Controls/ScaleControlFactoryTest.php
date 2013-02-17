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

use Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\ScaleControlStyle,
    Ivory\GoogleMapBundle\Model\Controls\ScaleControlFactory;

/**
 * Scale control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\ScaleControlFactory */
    protected $scaleControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->scaleControlFactory = new ScaleControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->scaleControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $scaleControl = $this->scaleControlFactory->create();

        $this->assertSame(ControlPosition::BOTTOM_LEFT, $scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl->getScaleControlStyle());
    }

    public function testCreateWithInitialValue()
    {
        $scaleControl = $this->scaleControlFactory->create(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $scaleControl->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $scaleControl->getScaleControlStyle());
    }
}
