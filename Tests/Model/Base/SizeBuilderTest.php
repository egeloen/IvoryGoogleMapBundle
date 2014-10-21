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

use Ivory\GoogleMapBundle\Model\Base\SizeBuilder;

/**
 * Size builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeBuilder */
    protected $sizeBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sizeBuilder = new SizeBuilder('Ivory\GoogleMap\Base\Size');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->sizeBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Base\Size', $this->sizeBuilder->getClass());
        $this->assertNull($this->sizeBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->sizeBuilder->getWidth());
        $this->assertNull($this->sizeBuilder->getHeight());
        $this->assertNull($this->sizeBuilder->getWidthUnit());
        $this->assertNull($this->sizeBuilder->getHeightUnit());
    }

    public function testSingleBuildWithoutValues()
    {
        $size = $this->sizeBuilder->build();

        $this->assertSame('size_', substr($size->getJavascriptVariable(), 0, 5));
        $this->assertSame(1, $size->getWidth());
        $this->assertSame(1, $size->getHeight());
        $this->assertNull($size->getWidthUnit());
        $this->assertNull($size->getHeightUnit());
    }

    public function testSingleBuildWithValues()
    {
        $this->sizeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setWidth(2)
            ->setHeight(3)
            ->setWidthUnit('px')
            ->setHeightUnit('pt');

        $this->assertSame('foo', $this->sizeBuilder->getPrefixJavascriptVariable());
        $this->assertSame(2, $this->sizeBuilder->getWidth());
        $this->assertSame(3, $this->sizeBuilder->getHeight());
        $this->assertSame('px', $this->sizeBuilder->getWidthUnit());
        $this->assertSame('pt', $this->sizeBuilder->getHeightUnit());

        $size = $this->sizeBuilder->build();

        $this->assertSame('foo', substr($size->getJavascriptVariable(), 0, 3));
        $this->assertSame(2, $size->getWidth());
        $this->assertSame(3, $size->getHeight());
        $this->assertSame('px', $size->getWidthUnit());
        $this->assertSame('pt', $size->getHeightUnit());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->sizeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setWidth(2)
            ->setHeight(3)
            ->setWidthUnit('px')
            ->setHeightUnit('pt');

        $size1 = $this->sizeBuilder->build();
        $size2 = $this->sizeBuilder->build();

        $this->assertNotSame($size1, $size2);

        $this->assertSame('foo', substr($size1->getJavascriptVariable(), 0, 3));
        $this->assertSame(2, $size1->getWidth());
        $this->assertSame(3, $size1->getHeight());
        $this->assertSame('px', $size1->getWidthUnit());
        $this->assertSame('pt', $size1->getHeightUnit());

        $this->assertSame('foo', substr($size2->getJavascriptVariable(), 0, 3));
        $this->assertSame(2, $size2->getWidth());
        $this->assertSame(3, $size2->getHeight());
        $this->assertSame('px', $size2->getWidthUnit());
        $this->assertSame('pt', $size2->getHeightUnit());
    }

    public function testMultipleBuildWithReset()
    {
        $this->sizeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setWidth(2)
            ->setHeight(3)
            ->setWidthUnit('px')
            ->setHeightUnit('pt');

        $size1 = $this->sizeBuilder->build();
        $this->sizeBuilder->reset();
        $size2 = $this->sizeBuilder->build();

        $this->assertSame('foo', substr($size1->getJavascriptVariable(), 0, 3));
        $this->assertSame(2, $size1->getWidth());
        $this->assertSame(3, $size1->getHeight());
        $this->assertSame('px', $size1->getWidthUnit());
        $this->assertSame('pt', $size1->getHeightUnit());

        $this->assertSame('size_', substr($size2->getJavascriptVariable(), 0, 5));
        $this->assertSame(1, $size2->getWidth());
        $this->assertSame(1, $size2->getHeight());
        $this->assertNull($size2->getWidthUnit());
        $this->assertNull($size2->getHeightUnit());
    }
}
