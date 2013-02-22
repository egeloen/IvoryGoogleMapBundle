<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Layers;

use Ivory\GoogleMapBundle\Model\Layers\KMLLayerBuilder;

/**
 * KML layer builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Layers\KMLLayerBuilder */
    protected $kmlLayerBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->kmlLayerBuilder = new KMLLayerBuilder('Ivory\GoogleMap\Layers\KMLLayer');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->kmlLayerBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Layers\KMLLayer', $this->kmlLayerBuilder->getClass());
        $this->assertNull($this->kmlLayerBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->kmlLayerBuilder->getUrl());
        $this->assertEmpty($this->kmlLayerBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $kmlLayer = $this->kmlLayerBuilder->build();

        $this->assertSame('kml_layer_', substr($kmlLayer->getJavascriptVariable(), 0, 10));
        $this->assertNull($kmlLayer->getUrl());
        $this->assertEmpty($kmlLayer->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->kmlLayerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setOptions(array('foo' => 'bar'));

        $kmlLayer = $this->kmlLayerBuilder->build();

        $this->assertSame('foo', substr($kmlLayer->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $kmlLayer->getUrl());
        $this->assertSame(array('foo' => 'bar'), $kmlLayer->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->kmlLayerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setOptions(array('foo' => 'bar'));

        $kmlLayer1 = $this->kmlLayerBuilder->build();
        $kmlLayer2 = $this->kmlLayerBuilder->build();

        $this->assertNotSame($kmlLayer1, $kmlLayer2);

        $this->assertSame('foo', substr($kmlLayer1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $kmlLayer1->getUrl());
        $this->assertSame(array('foo' => 'bar'), $kmlLayer1->getOptions());

        $this->assertSame('foo', substr($kmlLayer2->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $kmlLayer2->getUrl());
        $this->assertSame(array('foo' => 'bar'), $kmlLayer2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->kmlLayerBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setUrl('url')
            ->setOptions(array('foo' => 'bar'));

        $kmlLayer1 = $this->kmlLayerBuilder->build();
        $this->kmlLayerBuilder->reset();
        $kmlLayer2 = $this->kmlLayerBuilder->build();

        $this->assertSame('foo', substr($kmlLayer1->getJavascriptVariable(), 0, 3));
        $this->assertSame('url', $kmlLayer1->getUrl());
        $this->assertSame(array('foo' => 'bar'), $kmlLayer1->getOptions());

        $this->assertSame('kml_layer_', substr($kmlLayer2->getJavascriptVariable(), 0, 10));
        $this->assertNull($kmlLayer2->getUrl());
        $this->assertEmpty($kmlLayer2->getOptions());
    }
}
