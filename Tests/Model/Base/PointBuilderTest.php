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

use Ivory\GoogleMapBundle\Model\Base\PointBuilder;

/**
 * Point builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\PointBuilder */
    protected $pointBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointBuilder = new PointBuilder('Ivory\GoogleMap\Base\Point');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->pointBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Base\Point', $this->pointBuilder->getClass());
        $this->assertNull($this->pointBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->pointBuilder->getX());
        $this->assertNull($this->pointBuilder->getY());
    }

    public function testSingleBuildWithoutValues()
    {
        $point = $this->pointBuilder->build();

        $this->assertSame('point_', substr($point->getJavascriptVariable(), 0, 6));
        $this->assertSame(0, $point->getX());
        $this->assertSame(0, $point->getY());
    }

    public function testSingleBuildWithValue()
    {
        $this->pointBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setX(1)
            ->setY(2);

        $this->assertSame('foo', $this->pointBuilder->getPrefixJavascriptVariable());
        $this->assertSame(1, $this->pointBuilder->getX());
        $this->assertSame(2, $this->pointBuilder->getY());

        $point = $this->pointBuilder->build();

        $this->assertSame('foo', substr($point->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $point->getX());
        $this->assertSame(2, $point->getY());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->pointBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setX(1)
            ->setY(2);

        $point1 = $this->pointBuilder->build();
        $point2 = $this->pointBuilder->build();

        $this->assertNotSame($point1, $point2);

        $this->assertSame('foo', substr($point1->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $point1->getX());
        $this->assertSame(2, $point1->getY());

        $this->assertSame('foo', substr($point2->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $point2->getX());
        $this->assertSame(2, $point2->getY());
    }

    public function testMultipleBuildWithReset()
    {
        $this->pointBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setX(1)
            ->setY(2);

        $point1 = $this->pointBuilder->build();
        $this->pointBuilder->reset();
        $point2 = $this->pointBuilder->build();

        $this->assertSame('foo', substr($point1->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $point1->getX());
        $this->assertSame(2, $point1->getY());

        $this->assertSame('point_', substr($point2->getJavascriptVariable(), 0, 6));
        $this->assertSame(0, $point2->getX());
        $this->assertSame(0, $point2->getY());
    }
}
