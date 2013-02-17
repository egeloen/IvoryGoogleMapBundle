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
    Ivory\GoogleMap\Controls\ZoomControlStyle,
    Ivory\GoogleMapBundle\Model\Controls\ZoomControlFactory;

/**
 * Zoom control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\ZoomControlFactory */
    protected $zoomControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->zoomControlFactory = new ZoomControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->zoomControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $zoomControl = $this->zoomControlFactory->create();

        $this->assertSame(ControlPosition::TOP_LEFT, $zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::DEFAULT_, $zoomControl->getZoomControlStyle());
    }

    public function testCreateWithInitialValue()
    {
        $zoomControl = $this->zoomControlFactory->create(ControlPosition::BOTTOM_CENTER, ZoomControlStyle::LARGE);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $zoomControl->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $zoomControl->getZoomControlStyle());
    }
}
