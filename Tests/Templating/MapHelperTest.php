<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Templating;

use Ivory\GoogleMap\Helper\MapHelper as BaseMapHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Templating\MapHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelperTest extends TestCase
{
    /**
     * @var MapHelper
     */
    private $mapHelper;

    /**
     * @var BaseMapHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    private $innerMapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->innerMapHelper = $this->createMapHelperMock();
        $this->mapHelper = new MapHelper($this->innerMapHelper);
    }

    public function testRender()
    {
        $this->innerMapHelper
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->mapHelper->render($map));
    }

    public function testRenderHtml()
    {
        $this->innerMapHelper
            ->expects($this->once())
            ->method('renderHtml')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->mapHelper->renderHtml($map));
    }

    public function testRenderStylesheet()
    {
        $this->innerMapHelper
            ->expects($this->once())
            ->method('renderStylesheet')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->mapHelper->renderStylesheet($map));
    }

    public function testRenderJavascript()
    {
        $this->innerMapHelper
            ->expects($this->once())
            ->method('renderJavascript')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->mapHelper->renderJavascript($map));
    }

    public function testName()
    {
        $this->assertSame('ivory_google_map', $this->mapHelper->getName());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BaseMapHelper
     */
    private function createMapHelperMock()
    {
        return $this->createMock(BaseMapHelper::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
