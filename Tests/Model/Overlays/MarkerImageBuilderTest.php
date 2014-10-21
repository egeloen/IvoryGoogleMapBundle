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

use Ivory\GoogleMapBundle\Model\Base\PointBuilder;
use Ivory\GoogleMapBundle\Model\Base\SizeBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder;

/**
 * Marker image builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder */
    protected $markerImageBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\PointBuilder */
    protected $pointBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeBuilder */
    protected $sizeBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->pointBuilder = new PointBuilder('Ivory\GoogleMap\Base\Point');
        $this->sizeBuilder = new SizeBuilder('Ivory\GoogleMap\Base\Size');

        $this->markerImageBuilder = new MarkerImageBuilder(
            'Ivory\GoogleMap\Overlays\MarkerImage',
            $this->pointBuilder,
            $this->sizeBuilder
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerImageBuilder);
        unset($this->pointBuilder);
        unset($this->sizeBuilder);
    }

    public function testInitiasState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\MarkerImage', $this->markerImageBuilder->getClass());
        $this->assertSame($this->pointBuilder, $this->markerImageBuilder->getPointBuilder());
        $this->assertSame($this->sizeBuilder, $this->markerImageBuilder->getSizeBuilder());
        $this->assertNull($this->markerImageBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->markerImageBuilder->getUrl());
        $this->assertEmpty($this->markerImageBuilder->getAnchor());
        $this->assertEmpty($this->markerImageBuilder->getOrigin());
        $this->assertEmpty($this->markerImageBuilder->getScaledSize());
        $this->assertEmpty($this->markerImageBuilder->getSize());
    }

    public function testSingleBuildWithoutValues()
    {
        $markerImage = $this->markerImageBuilder->build();

        $this->assertSame('marker_image_', substr($markerImage->getJavascriptVariable(), 0, 13));
        $this->assertSame('//maps.gstatic.com/mapfiles/markers/marker.png', $markerImage->getUrl());
        $this->assertEmpty($markerImage->getAnchor());
        $this->assertEmpty($markerImage->getOrigin());
        $this->assertEmpty($markerImage->getScaledSize());
        $this->assertEmpty($markerImage->getSize());
    }

    public function testSingleBuildWithValues()
    {
        $this->markerImageBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setAnchor(1, 2)
            ->setOrigin(3, 4)
            ->setScaledSize(1, 2, 'px', 'pt')
            ->setSize(3, 4, 'pt', 'px');

        $this->assertSame('foo', $this->markerImageBuilder->getPrefixJavascriptVariable());
        $this->assertSame('url', $this->markerImageBuilder->getUrl());
        $this->assertSame(array(1, 2), $this->markerImageBuilder->getAnchor());
        $this->assertSame(array(3, 4), $this->markerImageBuilder->getOrigin());
        $this->assertSame(array(1, 2, 'px', 'pt'), $this->markerImageBuilder->getScaledSize());
        $this->assertSame(array(3, 4, 'pt', 'px'), $this->markerImageBuilder->getSize());

        $markerImage = $this->markerImageBuilder->build();

        $this->assertSame('foo', substr($markerImage->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $markerImage->getUrl());

        $this->assertSame(1, $markerImage->getAnchor()->getX());
        $this->assertSame(2, $markerImage->getAnchor()->getY());

        $this->assertSame(3, $markerImage->getOrigin()->getX());
        $this->assertSame(4, $markerImage->getOrigin()->getY());

        $this->assertSame(1, $markerImage->getScaledSize()->getWidth());
        $this->assertSame(2, $markerImage->getScaledSize()->getHeight());
        $this->assertSame('px', $markerImage->getScaledSize()->getWidthUnit());
        $this->assertSame('pt', $markerImage->getScaledSize()->getHeightUnit());

        $this->assertSame(3, $markerImage->getSize()->getWidth());
        $this->assertSame(4, $markerImage->getSize()->getHeight());
        $this->assertSame('pt', $markerImage->getSize()->getWidthUnit());
        $this->assertSame('px', $markerImage->getSize()->getHeightUnit());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->markerImageBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setAnchor(1, 2)
            ->setOrigin(3, 4)
            ->setScaledSize(1, 2, 'px', 'pt')
            ->setSize(3, 4, 'pt', 'px');

        $markerImage1 = $this->markerImageBuilder->build();
        $markerImage2 = $this->markerImageBuilder->build();

        $this->assertNotSame($markerImage1, $markerImage2);

        $this->assertSame('foo', substr($markerImage1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $markerImage1->getUrl());

        $this->assertSame(1, $markerImage1->getAnchor()->getX());
        $this->assertSame(2, $markerImage1->getAnchor()->getY());

        $this->assertSame(3, $markerImage1->getOrigin()->getX());
        $this->assertSame(4, $markerImage1->getOrigin()->getY());

        $this->assertSame(1, $markerImage1->getScaledSize()->getWidth());
        $this->assertSame(2, $markerImage1->getScaledSize()->getHeight());
        $this->assertSame('px', $markerImage1->getScaledSize()->getWidthUnit());
        $this->assertSame('pt', $markerImage1->getScaledSize()->getHeightUnit());

        $this->assertSame(3, $markerImage1->getSize()->getWidth());
        $this->assertSame(4, $markerImage1->getSize()->getHeight());
        $this->assertSame('pt', $markerImage1->getSize()->getWidthUnit());
        $this->assertSame('px', $markerImage1->getSize()->getHeightUnit());

        $this->assertSame('foo', substr($markerImage2->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $markerImage2->getUrl());

        $this->assertSame(1, $markerImage2->getAnchor()->getX());
        $this->assertSame(2, $markerImage2->getAnchor()->getY());

        $this->assertSame(3, $markerImage2->getOrigin()->getX());
        $this->assertSame(4, $markerImage2->getOrigin()->getY());

        $this->assertSame(1, $markerImage2->getScaledSize()->getWidth());
        $this->assertSame(2, $markerImage2->getScaledSize()->getHeight());
        $this->assertSame('px', $markerImage2->getScaledSize()->getWidthUnit());
        $this->assertSame('pt', $markerImage2->getScaledSize()->getHeightUnit());

        $this->assertSame(3, $markerImage2->getSize()->getWidth());
        $this->assertSame(4, $markerImage2->getSize()->getHeight());
        $this->assertSame('pt', $markerImage2->getSize()->getWidthUnit());
        $this->assertSame('px', $markerImage2->getSize()->getHeightUnit());
    }

    public function testMultipleBuildWithReset()
    {
        $this->markerImageBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setAnchor(1, 2)
            ->setOrigin(3, 4)
            ->setScaledSize(1, 2, 'px', 'pt')
            ->setSize(3, 4, 'pt', 'px');

        $markerImage1 = $this->markerImageBuilder->build();
        $this->markerImageBuilder->reset();
        $markerImage2 = $this->markerImageBuilder->build();

        $this->assertSame('foo', substr($markerImage1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $markerImage1->getUrl());

        $this->assertSame(1, $markerImage1->getAnchor()->getX());
        $this->assertSame(2, $markerImage1->getAnchor()->getY());

        $this->assertSame(3, $markerImage1->getOrigin()->getX());
        $this->assertSame(4, $markerImage1->getOrigin()->getY());

        $this->assertSame(1, $markerImage1->getScaledSize()->getWidth());
        $this->assertSame(2, $markerImage1->getScaledSize()->getHeight());
        $this->assertSame('px', $markerImage1->getScaledSize()->getWidthUnit());
        $this->assertSame('pt', $markerImage1->getScaledSize()->getHeightUnit());

        $this->assertSame(3, $markerImage1->getSize()->getWidth());
        $this->assertSame(4, $markerImage1->getSize()->getHeight());
        $this->assertSame('pt', $markerImage1->getSize()->getWidthUnit());
        $this->assertSame('px', $markerImage1->getSize()->getHeightUnit());

        $this->assertSame('marker_image_', substr($markerImage2->getJavascriptVariable(), 0, 13));
        $this->assertSame('//maps.gstatic.com/mapfiles/markers/marker.png', $markerImage2->getUrl());
        $this->assertEmpty($markerImage2->getAnchor());
        $this->assertEmpty($markerImage2->getOrigin());
        $this->assertEmpty($markerImage2->getScaledSize());
        $this->assertEmpty($markerImage2->getSize());
    }
}
