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
    Ivory\GoogleMapBundle\Model\Controls\PanControlFactory;

/**
 * Pan control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\PanControlFactory */
    protected $panControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControlFactory = new PanControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $panControl = $this->panControlFactory->create();

        $this->assertSame(ControlPosition::TOP_LEFT, $panControl->getControlPosition());
    }

    public function testCreateWithInitialValue()
    {
        $panControl = $this->panControlFactory->create(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl->getControlPosition());
    }
}
