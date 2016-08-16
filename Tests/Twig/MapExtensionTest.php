<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Twig;

use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Twig\MapExtension;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapExtensionTest extends AbstractExtensionTest
{
    /**
     * @var MapHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function createExtension()
    {
        $this->mapHelper = $this->createMapHelperMock();

        return new MapExtension($this->mapHelper);
    }

    public function testRender()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_map(map) }}');

        $this->mapHelper
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['map' => $map]));
    }

    public function testRenderHtml()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_map_container(map) }}');

        $this->mapHelper
            ->expects($this->once())
            ->method('renderHtml')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['map' => $map]));
    }

    public function testRenderStylesheet()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_map_css(map) }}');

        $this->mapHelper
            ->expects($this->once())
            ->method('renderStylesheet')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['map' => $map]));
    }

    public function testRenderJavascript()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_map_js(map) }}');

        $this->mapHelper
            ->expects($this->once())
            ->method('renderJavascript')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['map' => $map]));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MapHelper
     */
    private function createMapHelperMock()
    {
        return $this->createMock(MapHelper::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
