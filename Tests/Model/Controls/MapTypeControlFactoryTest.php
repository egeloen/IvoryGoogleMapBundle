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
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\MapTypeId,
    Ivory\GoogleMapBundle\Model\Controls\MapTypeControlFactory;

/**
 * Map type control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\MapTypeControlFactory */
    protected $mapTypeControlfactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapTypeControlfactory = new MapTypeControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapTypeControlfactory);
    }

    public function testCreateWithDefaultValue()
    {
        $mapTypeControl = $this->mapTypeControlfactory->create();

        $this->assertSame(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE), $mapTypeControl->getMapTypeIds());
        $this->assertSame(ControlPosition::TOP_RIGHT, $mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DEFAULT_, $mapTypeControl->getMapTypeControlStyle());
    }

    public function testCreateWithInitialValue()
    {
        $mapTypeControl = $this->mapTypeControlfactory->create(
            array(MapTypeId::HYBRID),
            ControlPosition::BOTTOM_CENTER,
            MapTypeControlStyle::DROPDOWN_MENU
        );

        $this->assertSame(array(MapTypeId::HYBRID), $mapTypeControl->getMapTypeIds());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $mapTypeControl->getControlPosition());
        $this->assertSame(MapTypeControlStyle::DROPDOWN_MENU, $mapTypeControl->getMapTypeControlStyle());
    }
}
