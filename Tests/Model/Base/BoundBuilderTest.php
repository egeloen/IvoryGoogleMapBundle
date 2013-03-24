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

use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;

/**
 * Bound builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate');
        $this->boundBuilder = new BoundBuilder('Ivory\GoogleMap\Base\Bound', $this->coordinateBuilder);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->boundBuilder);
        unset($this->coordinateBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Base\Bound', $this->boundBuilder->getClass());
        $this->assertSame($this->coordinateBuilder, $this->boundBuilder->getCoordinateBuilder());
        $this->assertEmpty($this->boundBuilder->getSouthWest());
        $this->assertEmpty($this->boundBuilder->getNorthEast());
    }

    public function testSingleBuildWithoutValues()
    {
        $bound = $this->boundBuilder->build();

        $this->assertSame('bound_', substr($bound->getJavascriptVariable(), 0, 6));
        $this->assertFalse($bound->hasCoordinates());
    }

    public function testSingleBuildWithValues()
    {
        $this->boundBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setSouthWest(1, 2, true)
            ->setNorthEast(3, 4, false);

        $this->assertSame('foo', $this->boundBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(1, 2, true), $this->boundBuilder->getSouthWest());
        $this->assertSame(array(3, 4, false), $this->boundBuilder->getNorthEast());

        $bound = $this->boundBuilder->build();

        $this->assertSame('foo', substr($bound->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $bound->getSouthWest()->getLatitude());
        $this->assertSame(2, $bound->getSouthWest()->getLongitude());
        $this->assertTrue($bound->getSouthWest()->isNoWrap());

        $this->assertSame(3, $bound->getNorthEast()->getLatitude());
        $this->assertSame(4, $bound->getNorthEast()->getLongitude());
        $this->assertFalse($bound->getNorthEast()->isNoWrap());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->boundBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setSouthWest(1, 2, true)
            ->setNorthEast(3, 4, false);

        $bound1 = $this->boundBuilder->build();
        $bound2 = $this->boundBuilder->build();

        $this->assertNotSame($bound1, $bound2);

        $this->assertSame('foo', substr($bound1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $bound1->getSouthWest()->getLatitude());
        $this->assertSame(2, $bound1->getSouthWest()->getLongitude());
        $this->assertTrue($bound1->getSouthWest()->isNoWrap());

        $this->assertSame(3, $bound1->getNorthEast()->getLatitude());
        $this->assertSame(4, $bound1->getNorthEast()->getLongitude());
        $this->assertFalse($bound1->getNorthEast()->isNoWrap());

        $this->assertSame('foo', substr($bound2->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $bound2->getSouthWest()->getLatitude());
        $this->assertSame(2, $bound2->getSouthWest()->getLongitude());
        $this->assertTrue($bound2->getSouthWest()->isNoWrap());

        $this->assertSame(3, $bound2->getNorthEast()->getLatitude());
        $this->assertSame(4, $bound2->getNorthEast()->getLongitude());
        $this->assertFalse($bound2->getNorthEast()->isNoWrap());
    }

    public function testMultipleBuildWithReset()
    {
        $this->boundBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setSouthWest(1, 2, true)
            ->setNorthEast(3, 4, false);

        $bound1 = $this->boundBuilder->build();
        $this->boundBuilder->reset();
        $bound2 = $this->boundBuilder->build();

        $this->assertSame('foo', substr($bound1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $bound1->getSouthWest()->getLatitude());
        $this->assertSame(2, $bound1->getSouthWest()->getLongitude());
        $this->assertTrue($bound1->getSouthWest()->isNoWrap());

        $this->assertSame(3, $bound1->getNorthEast()->getLatitude());
        $this->assertSame(4, $bound1->getNorthEast()->getLongitude());
        $this->assertFalse($bound1->getNorthEast()->isNoWrap());

        $this->assertSame('bound_', substr($bound2->getJavascriptVariable(), 0, 6));
        $this->assertFalse($bound2->hasCoordinates());
    }
}
