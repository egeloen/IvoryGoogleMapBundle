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
    Ivory\GoogleMapBundle\Model\Controls\RotateControlFactory;

/**
 * Rotate control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\RotateControlFactory */
    protected $rotateControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rotateControlFactory = new RotateControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rotateControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $rotateControl = $this->rotateControlFactory->create();

        $this->assertSame(ControlPosition::TOP_LEFT, $rotateControl->getControlPosition());
    }

    public function testCreateWithInitialValue()
    {
        $rotateControl = $this->rotateControlFactory->create(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $rotateControl->getControlPosition());
    }
}
