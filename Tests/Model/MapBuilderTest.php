<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model;

use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\MapBuilder;

/**
 * Map builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\MapBuilder */
    protected $mapBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate');
        $this->boundBuilder = new BoundBuilder('Ivory\GoogleMap\Base\Bound', $this->coordinateBuilder);
        $this->mapBuilder = new MapBuilder('Ivory\GoogleMap\Map', $this->coordinateBuilder, $this->boundBuilder);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->mapBuilder);
        unset($this->boundBuilder);
        unset($this->coordinateBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Map', $this->mapBuilder->getClass());
        $this->assertSame($this->boundBuilder, $this->mapBuilder->getBoundBuilder());
        $this->assertSame($this->coordinateBuilder, $this->mapBuilder->getCoordinateBuilder());
        $this->assertNull($this->mapBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->mapBuilder->getHtmlContainerId());
        $this->assertNull($this->mapBuilder->getAsync());
        $this->assertNull($this->mapBuilder->getAutoZoom());
        $this->assertEmpty($this->mapBuilder->getLibraries());
        $this->assertNull($this->mapBuilder->getLanguage());
        $this->assertEmpty($this->mapBuilder->getCenter());
        $this->assertEmpty($this->mapBuilder->getBound());
        $this->assertEmpty($this->mapBuilder->getMapOptions());
        $this->assertEmpty($this->mapBuilder->getStylesheetOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $map = $this->mapBuilder->build();

        $this->assertSame('map_', substr($map->getJavascriptVariable(), 0, 4));
        $this->assertSame('map_canvas', $map->getHtmlContainerId());
        $this->assertFalse($map->isAsync());
        $this->assertFalse($map->isAutoZoom());
        $this->assertFalse($map->hasLibraries());
        $this->assertSame('en', $map->getLanguage());

        $this->assertSame(0, $map->getCenter()->getLatitude());
        $this->assertSame(0, $map->getCenter()->getLongitude());
        $this->assertTrue($map->getCenter()->isNoWrap());

        $this->assertFalse($map->getBound()->hasCoordinates());
        $this->assertSame(array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3), $map->getMapOptions());
        $this->assertSame(array('width' => '300px', 'height' => '300px'), $map->getStylesheetOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->mapBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setHtmlContainerId('bar')
            ->setAsync(true)
            ->setAutoZoom(true)
            ->setLibraries(array('foo'))
            ->setLanguage('fr')
            ->setCenter(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setMapOptions(array('foo' => 'bar'))
            ->setStylesheetOptions(array('bar' => 'foo'));

        $this->assertSame('foo', $this->mapBuilder->getPrefixJavascriptVariable());
        $this->assertSame('bar', $this->mapBuilder->getHtmlContainerId());
        $this->assertTrue($this->mapBuilder->getAsync());
        $this->assertTrue($this->mapBuilder->getAutoZoom());
        $this->assertSame(array('foo'), $this->mapBuilder->getLibraries());
        $this->assertSame('fr', $this->mapBuilder->getLanguage());

        $this->assertSame(array(1, 2, false), $this->mapBuilder->getCenter());
        $this->assertSame(array(1, 2, true, 3, 4, false), $this->mapBuilder->getBound());
        $this->assertSame(array('foo' => 'bar'), $this->mapBuilder->getMapOptions());
        $this->assertSame(array('bar' => 'foo'), $this->mapBuilder->getStylesheetOptions());

        $map = $this->mapBuilder->build();

        $this->assertSame('foo', substr($map->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $map->getHtmlContainerId());
        $this->assertTrue($map->isAsync());
        $this->assertTrue($map->isAutoZoom());
        $this->assertSame(array('foo'), $map->getLibraries());
        $this->assertSame('fr', $map->getLanguage());

        $this->assertSame(1, $map->getCenter()->getLatitude());
        $this->assertSame(2, $map->getCenter()->getLongitude());
        $this->assertFalse($map->getCenter()->isNoWrap());

        $this->assertSame(1, $map->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $map->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($map->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $map->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $map->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($map->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(
            array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3, 'foo' => 'bar'),
            $map->getMapOptions()
        );

        $this->assertSame(
            array('width' => '300px', 'height' => '300px', 'bar' => 'foo'),
            $map->getStylesheetOptions()
        );
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->mapBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setHtmlContainerId('bar')
            ->setAsync(true)
            ->setAutoZoom(true)
            ->setLibraries(array('foo'))
            ->setLanguage('fr')
            ->setCenter(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setMapOptions(array('foo' => 'bar'))
            ->setStylesheetOptions(array('bar' => 'foo'));

        $map1 = $this->mapBuilder->build();
        $map2 = $this->mapBuilder->build();

        $this->assertNotSame($map1, $map2);

        $this->assertSame('foo', substr($map1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $map1->getHtmlContainerId());
        $this->assertTrue($map1->isAsync());
        $this->assertTrue($map1->isAutoZoom());
        $this->assertSame(array('foo'), $map1->getLibraries());
        $this->assertSame('fr', $map1->getLanguage());

        $this->assertSame(1, $map1->getCenter()->getLatitude());
        $this->assertSame(2, $map1->getCenter()->getLongitude());
        $this->assertFalse($map1->getCenter()->isNoWrap());

        $this->assertSame(1, $map1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $map1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($map1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $map1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $map1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($map1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(
            array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3, 'foo' => 'bar'),
            $map1->getMapOptions()
        );

        $this->assertSame(
            array('width' => '300px', 'height' => '300px', 'bar' => 'foo'),
            $map1->getStylesheetOptions()
        );

        $this->assertSame('foo', substr($map2->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $map2->getHtmlContainerId());
        $this->assertTrue($map2->isAsync());
        $this->assertTrue($map2->isAutoZoom());

        $this->assertSame(1, $map2->getCenter()->getLatitude());
        $this->assertSame(2, $map2->getCenter()->getLongitude());
        $this->assertFalse($map2->getCenter()->isNoWrap());
        $this->assertSame(array('foo'), $map2->getLibraries());
        $this->assertSame('fr', $map2->getLanguage());

        $this->assertSame(1, $map2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $map2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($map2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $map2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $map2->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($map2->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(
            array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3, 'foo' => 'bar'),
            $map2->getMapOptions()
        );

        $this->assertSame(
            array('width' => '300px', 'height' => '300px', 'bar' => 'foo'),
            $map2->getStylesheetOptions()
        );
    }

    public function testMultipleBuildWithReset()
    {
        $this->mapBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setHtmlContainerId('bar')
            ->setAsync(true)
            ->setAutoZoom(true)
            ->setLibraries(array('foo'))
            ->setLanguage('fr')
            ->setCenter(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setMapOptions(array('foo' => 'bar'))
            ->setStylesheetOptions(array('bar' => 'foo'));

        $map1 = $this->mapBuilder->build();
        $this->mapBuilder->reset();
        $map2 = $this->mapBuilder->build();

        $this->assertSame('foo', substr($map1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $map1->getHtmlContainerId());
        $this->assertTrue($map1->isAsync());
        $this->assertTrue($map1->isAutoZoom());
        $this->assertSame(array('foo'), $map1->getLibraries());
        $this->assertSame('fr', $map1->getLanguage());

        $this->assertSame(1, $map1->getCenter()->getLatitude());
        $this->assertSame(2, $map1->getCenter()->getLongitude());
        $this->assertFalse($map1->getCenter()->isNoWrap());

        $this->assertSame(1, $map1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $map1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($map1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $map1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $map1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($map1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(
            array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3, 'foo' => 'bar'),
            $map1->getMapOptions()
        );

        $this->assertSame(
            array('width' => '300px', 'height' => '300px', 'bar' => 'foo'),
            $map1->getStylesheetOptions()
        );

        $this->assertSame('map_', substr($map2->getJavascriptVariable(), 0, 4));
        $this->assertSame('map_canvas', $map2->getHtmlContainerId());
        $this->assertFalse($map2->isAsync());
        $this->assertFalse($map2->isAutoZoom());
        $this->assertEmpty($map2->getLibraries());
        $this->assertSame('en', $map2->getLanguage());

        $this->assertSame(0, $map2->getCenter()->getLatitude());
        $this->assertSame(0, $map2->getCenter()->getLongitude());
        $this->assertTrue($map2->getCenter()->isNoWrap());

        $this->assertFalse($map2->getBound()->hasCoordinates());
        $this->assertSame(array('mapTypeId' => MapTypeId::ROADMAP, 'zoom' => 3), $map2->getMapOptions());
        $this->assertSame(array('width' => '300px', 'height' => '300px'), $map2->getStylesheetOptions());
    }
}
