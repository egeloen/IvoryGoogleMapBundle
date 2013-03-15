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

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolylineBuilder;

/**
 * Encoded polyline builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\EncodedPolylineBuilder */
    protected $encodedPolylineBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->encodedPolylineBuilder = new EncodedPolylineBuilder('Ivory\GoogleMap\Overlays\EncodedPolyline');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->encodedPolylineBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\EncodedPolyline', $this->encodedPolylineBuilder->getClass());
        $this->assertNull($this->encodedPolylineBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->encodedPolylineBuilder->getValue());
        $this->assertEmpty($this->encodedPolylineBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $encodedPolyline = $this->encodedPolylineBuilder->build();

        $this->assertSame('encoded_polyline_', substr($encodedPolyline->getJavascriptVariable(), 0, 17));
        $this->assertNull($encodedPolyline->getValue());
        $this->assertEmpty($encodedPolyline->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->encodedPolylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setValue('bar')
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->encodedPolylineBuilder->getPrefixJavascriptVariable());
        $this->assertSame('bar', $this->encodedPolylineBuilder->getValue());
        $this->assertSame(array('foo' => 'bar'), $this->encodedPolylineBuilder->getOptions());

        $encodedPolyline = $this->encodedPolylineBuilder->build();

        $this->assertSame('foo', substr($encodedPolyline->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $encodedPolyline->getValue());
        $this->assertSame(array('foo' => 'bar'), $encodedPolyline->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->encodedPolylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setValue('bar')
            ->setOptions(array('foo' => 'bar'));

        $encodedPolyline1 = $this->encodedPolylineBuilder->build();
        $encodedPolyline2 = $this->encodedPolylineBuilder->build();

        $this->assertNotSame($encodedPolyline1, $encodedPolyline2);

        $this->assertSame('foo', substr($encodedPolyline1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $encodedPolyline1->getValue());
        $this->assertSame(array('foo' => 'bar'), $encodedPolyline1->getOptions());

        $this->assertSame('foo', substr($encodedPolyline2->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $encodedPolyline2->getValue());
        $this->assertSame(array('foo' => 'bar'), $encodedPolyline2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->encodedPolylineBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setValue('bar')
            ->setOptions(array('foo' => 'bar'));

        $encodedPolyline1 = $this->encodedPolylineBuilder->build();
        $this->encodedPolylineBuilder->reset();
        $encodedPolyline2 = $this->encodedPolylineBuilder->build();

        $this->assertNotSame($encodedPolyline1, $encodedPolyline2);

        $this->assertSame('foo', substr($encodedPolyline1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $encodedPolyline1->getValue());
        $this->assertSame(array('foo' => 'bar'), $encodedPolyline1->getOptions());

        $this->assertSame('encoded_polyline_', substr($encodedPolyline2->getJavascriptVariable(), 0, 17));
        $this->assertNull($encodedPolyline2->getValue());
        $this->assertEmpty($encodedPolyline2->getOptions());
    }
}
