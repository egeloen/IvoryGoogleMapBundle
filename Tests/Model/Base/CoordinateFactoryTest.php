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

use Ivory\GoogleMapBundle\Model\Base\CoordinateFactory;

/**
 * Coordinate factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateFactory */
    protected $coordinateFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateFactory = new CoordinateFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinateFactory);
    }

    public function teatCreateWithDefaultValue()
    {
        $coordinate = $this->coordinateFactory->create();

        $this->assertSame(0, $coordinate->getLatitude());
        $this->assertSame(0, $coordinate->getLongitude());
        $this->assertTrue($coordinate->isNoWrap());
    }

    public function testCreateWithInitialValue()
    {
        $coordinate = $this->coordinateFactory->create(1, 2, false);

        $this->assertSame(1, $coordinate->getLatitude());
        $this->assertSame(2, $coordinate->getLongitude());
        $this->assertFalse($coordinate->isNoWrap());
    }
}
