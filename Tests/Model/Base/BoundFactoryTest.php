<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Model\Base\BoundFactory;

/**
 * Bound factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundFactory */
    protected $boundFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundFactory = new BoundFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundFactory);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf(
            'Ivory\GoogleMapBundle\Model\Base\CoordinateFactory',
            $this->boundFactory->getCoordinateFactory()
        );
    }

    public function testInitialState()
    {
        $coordinateFactory = $this->getMock('Ivory\GoogleMapBundle\Model\Base\CoordinateFactory');

        $this->boundFactory = new BoundFactory($coordinateFactory);

        $this->assertSame($coordinateFactory, $this->boundFactory->getCoordinateFactory());
    }

    public function testCreateWithDefaultValue()
    {
        $bound = $this->boundFactory->create('foo', 1, 2, 3, 4);

        $this->assertSame('foo', substr($bound->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $bound->getSouthWest()->getLatitude());
        $this->assertSame(2, $bound->getSouthWest()->getLongitude());
        $this->assertTrue($bound->getSouthWest()->isNoWrap());

        $this->assertSame(3, $bound->getNorthEast()->getLatitude());
        $this->assertSame(4, $bound->getNorthEast()->getLongitude());
        $this->assertTrue($bound->getNorthEast()->isNoWrap());
    }

    public function testCreateWithInitialValue()
    {
        $bound = $this->boundFactory->create('foo', 1, 2, 3, 4, false, true);

        $this->assertFalse($bound->getSouthWest()->isNoWrap());
        $this->assertTrue($bound->getNorthEast()->isNoWrap());
    }
}
