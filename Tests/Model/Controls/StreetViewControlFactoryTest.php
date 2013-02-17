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
    Ivory\GoogleMapBundle\Model\Controls\StreetViewControlFactory;

/**
 * Street view control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\StreetViewControlFactory */
    protected $streetViewControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControlFactory = new StreetViewControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $streetViewControl = $this->streetViewControlFactory->create();

        $this->assertSame(ControlPosition::TOP_LEFT, $streetViewControl->getControlPosition());
    }

    public function testCreateWithInitialValue()
    {
        $streetViewControl = $this->streetViewControlFactory->create(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $streetViewControl->getControlPosition());
    }
}
