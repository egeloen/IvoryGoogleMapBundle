<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\RectangleBuilder;

/**
 * Rectangle builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\RectangleBuilder */
    protected $rectangleBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->boundBuilder = new BoundBuilder(
            'Ivory\GoogleMap\Base\Bound',
            new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate')
        );

        $this->rectangleBuilder = new RectangleBuilder('Ivory\GoogleMap\Overlays\Rectangle', $this->boundBuilder);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangleBuilder);
        unset($this->boundBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\Rectangle', $this->rectangleBuilder->getClass());
        $this->assertSame($this->boundBuilder, $this->rectangleBuilder->getBoundBuilder());
        $this->assertNull($this->boundBuilder->getPrefixJavascriptVariable());
        $this->assertEmpty($this->rectangleBuilder->getBound());
        $this->assertEmpty($this->rectangleBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $rectangle = $this->rectangleBuilder->build();

        $this->assertSame('rectangle_', substr($rectangle->getJavascriptVariable(), 0, 10));

        $this->assertSame(-1, $rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(1, $rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertEmpty($rectangle->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->rectangleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setBound(1, 2, 3, 4, true, false)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->rectangleBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(1, 2, true, 3, 4, false), $this->rectangleBuilder->getBound());
        $this->assertSame(array('foo' => 'bar'), $this->rectangleBuilder->getOptions());

        $rectangle = $this->rectangleBuilder->build();

        $this->assertSame('foo', substr($rectangle->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $rectangle->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->rectangleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setBound(1, 2, 3, 4, true, false)
            ->setOptions(array('foo' => 'bar'));

        $rectangle1 = $this->rectangleBuilder->build();
        $rectangle2 = $this->rectangleBuilder->build();

        $this->assertNotSame($rectangle1, $rectangle2);

        $this->assertSame('foo', substr($rectangle1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $rectangle1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $rectangle1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $rectangle1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $rectangle1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($rectangle1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $rectangle1->getOptions());

        $this->assertSame('foo', substr($rectangle2->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $rectangle2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $rectangle2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $rectangle2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $rectangle2->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($rectangle2->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $rectangle2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->rectangleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setBound(1, 2, 3, 4, true, false)
            ->setOptions(array('foo' => 'bar'));

        $rectangle1 = $this->rectangleBuilder->build();
        $this->rectangleBuilder->reset();
        $rectangle2 = $this->rectangleBuilder->build();

        $this->assertSame('foo', substr($rectangle1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $rectangle1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $rectangle1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $rectangle1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $rectangle1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($rectangle1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(array('foo' => 'bar'), $rectangle1->getOptions());

        $this->assertSame('rectangle_', substr($rectangle2->getJavascriptVariable(), 0, 10));

        $this->assertSame(-1, $rectangle2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $rectangle2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($rectangle2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(1, $rectangle2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $rectangle2->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($rectangle2->getBound()->getNorthEast()->isNoWrap());

        $this->assertEmpty($rectangle2->getOptions());
    }
}
