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

use Ivory\GoogleMapBundle\Model\Base\PointFactory;

/**
 * Point factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\PointFactory */
    protected $pointFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointFactory = new PointFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->pointFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $point = $this->pointFactory->create();

        $this->assertSame(0, $point->getX());
        $this->assertSame(0, $point->getY());
    }

    public function testCreateWithInitialValue()
    {
        $point = $this->pointFactory->create(1, 2);

        $this->assertSame(1, $point->getX());
        $this->assertSame(2, $point->getY());
    }
}
