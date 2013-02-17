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

use Ivory\GoogleMapBundle\Model\Base\SizeFactory;

/**
 * Size factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeFactory */
    protected $sizeFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeFactory = new SizeFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->sizeFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $size = $this->sizeFactory->create();

        $this->assertSame(1, $size->getWidth());
        $this->assertSame(1, $size->getHeight());
        $this->assertNull($size->getWidthUnit());
        $this->assertNull($size->getHeightUnit());
    }

    public function testCreateWithInitialValue()
    {
        $size = $this->sizeFactory->create(2, 3, 'px', 'pt');

        $this->assertSame(2, $size->getWidth());
        $this->assertSame(3, $size->getHeight());
        $this->assertSame('px', $size->getWidthUnit());
        $this->assertSame('pt', $size->getHeightUnit());
    }
}
