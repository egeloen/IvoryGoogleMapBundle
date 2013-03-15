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

use Ivory\GoogleMapBundle\Model\Overlays\MarkerShapeBuilder;

/**
 * Marker shape builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\MarkerShapeBuilder */
    protected $markerShapeBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerShapeBuilder = new MarkerShapeBuilder('Ivory\GoogleMap\Overlays\MarkerShape');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerShapeBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\MarkerShape', $this->markerShapeBuilder->getClass());
        $this->assertNull($this->markerShapeBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->markerShapeBuilder->getType());
        $this->assertEmpty($this->markerShapeBuilder->getCoordinates());
    }

    public function testSingleBuildWithoutValues()
    {
        $markerShape = $this->markerShapeBuilder->build();

        $this->assertSame('marker_shape_', substr($markerShape->getJavascriptVariable(), 0, 13));
        $this->assertSame('poly', $markerShape->getType());
        $this->assertSame(array(1, 1, 1, -1, -1, -1, -1, 1), $markerShape->getCoordinates());
    }

    public function testSingleBuildWithValues()
    {
        $this->markerShapeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType('rect')
            ->setCoordinates(array(-1, -1, 1, 1));

        $this->assertSame('foo', $this->markerShapeBuilder->getPrefixJavascriptVariable());
        $this->assertSame('rect', $this->markerShapeBuilder->getType());
        $this->assertSame(array(-1, -1, 1, 1), $this->markerShapeBuilder->getCoordinates());

        $markerShape = $this->markerShapeBuilder->build();

        $this->assertSame('foo', substr($markerShape->getJavascriptVariable(), 0, 3));
        $this->assertSame('rect', $markerShape->getType());
        $this->assertSame(array(-1, -1, 1, 1), $markerShape->getCoordinates());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->markerShapeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType('rect')
            ->setCoordinates(array(-1, -1, 1, 1));

        $markerShape1 = $this->markerShapeBuilder->build();
        $markerShape2 = $this->markerShapeBuilder->build();

        $this->assertNotSame($markerShape1, $markerShape2);

        $this->assertSame('foo', substr($markerShape1->getJavascriptVariable(), 0, 3));
        $this->assertSame('rect', $markerShape1->getType());
        $this->assertSame(array(-1, -1, 1, 1), $markerShape1->getCoordinates());

        $this->assertSame('foo', substr($markerShape2->getJavascriptVariable(), 0, 3));
        $this->assertSame('rect', $markerShape2->getType());
        $this->assertSame(array(-1, -1, 1, 1), $markerShape2->getCoordinates());
    }

    public function testMultipleBuildWithReset()
    {
        $this->markerShapeBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType('rect')
            ->setCoordinates(array(-1, -1, 1, 1));

        $markerShape1 = $this->markerShapeBuilder->build();
        $this->markerShapeBuilder->reset();
        $markerShape2 = $this->markerShapeBuilder->build();

        $this->assertSame('foo', substr($markerShape1->getJavascriptVariable(), 0, 3));
        $this->assertSame('rect', $markerShape1->getType());
        $this->assertSame(array(-1, -1, 1, 1), $markerShape1->getCoordinates());

        $this->assertSame('marker_shape_', substr($markerShape2->getJavascriptVariable(), 0, 13));
        $this->assertSame('poly', $markerShape2->getType());
        $this->assertSame(array(1, 1, 1, -1, -1, -1, -1, 1), $markerShape2->getCoordinates());
    }
}
