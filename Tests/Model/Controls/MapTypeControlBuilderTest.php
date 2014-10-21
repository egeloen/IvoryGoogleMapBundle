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
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlBuilder;

/**
 * Map type control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\MapTypeControlBuilder */
    protected $mapTypeControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlBuilder = new MapTypeControlBuilder('Ivory\GoogleMap\Controls\MapTypeControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Controls\MapTypeControl', $this->mapTypeControlBuilder->getClass());
        $this->assertEmpty($this->mapTypeControlBuilder->getMapTypeIds());
        $this->assertNull($this->mapTypeControlBuilder->getControlPosition());
        $this->assertNull($this->mapTypeControlBuilder->getMapTypeControlStyle());
    }

    public function testSingleBuildWithoutValues()
    {
        $mapTypeControl = $this->mapTypeControlBuilder->build();

        $this->assertSame(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE), $mapTypeControl->getMapTypeIds());
        $this->assertSame(ControlPosition::TOP_RIGHT, $mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $mapTypeControl->getMapTypeControlStyle());
    }

    public function testSingleBuildWithValues()
    {
        $this->mapTypeControlBuilder
            ->setMapTypeIds(array(MapTypeId::HYBRID))
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);

        $this->assertSame(array(MapTypeId::HYBRID), $this->mapTypeControlBuilder->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->mapTypeControlBuilder->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $this->mapTypeControlBuilder->getMapTypeControlStyle());

        $mapTypeControl = $this->mapTypeControlBuilder->build();

        $this->assertSame(array(MapTypeId::HYBRID), $mapTypeControl->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $mapTypeControl->getMapTypeControlStyle());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->mapTypeControlBuilder
            ->setMapTypeIds(array(MapTypeId::HYBRID))
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);

        $mapTypeControl1 = $this->mapTypeControlBuilder->build();
        $mapTypeControl2 = $this->mapTypeControlBuilder->build();

        $this->assertNotSame($mapTypeControl1, $mapTypeControl2);

        $this->assertSame(array(MapTypeId::HYBRID), $mapTypeControl1->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $mapTypeControl1->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $mapTypeControl1->getMapTypeControlStyle());

        $this->assertSame(array(MapTypeId::HYBRID), $mapTypeControl2->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $mapTypeControl2->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $mapTypeControl2->getMapTypeControlStyle());
    }

    public function testMultipleBuildWithReset()
    {
        $this->mapTypeControlBuilder
            ->setMapTypeIds(array(MapTypeId::HYBRID))
            ->setControlPosition(ControlPosition::BOTTOM_CENTER)
            ->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);

        $mapTypeControl1 = $this->mapTypeControlBuilder->build();
        $this->mapTypeControlBuilder->reset();
        $mapTypeControl2 = $this->mapTypeControlBuilder->build();

        $this->assertSame(array(MapTypeId::HYBRID), $mapTypeControl1->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $mapTypeControl1->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $mapTypeControl1->getMapTypeControlStyle());

        $this->assertSame(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE), $mapTypeControl2->getMapTypeIds());
        $this->assertSame(ControlPosition::TOP_RIGHT, $mapTypeControl2->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $mapTypeControl2->getMapTypeControlStyle());
    }
}
