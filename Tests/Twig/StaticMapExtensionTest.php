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

use Ivory\GoogleMap\Helper\StaticMapHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Twig\StaticMapExtension;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapExtensionTest extends AbstractExtensionTest
{
    /**
     * @var StaticMapHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    private $staticMapHelper;

    /**
     * {@inheritdoc}
     */
    protected function createExtension()
    {
        $this->staticMapHelper = $this->createStaticMapHelperMock();

        return new StaticMapExtension($this->staticMapHelper);
    }

    public function testRender()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_map_static(map) }}');

        $this->staticMapHelper
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($map = $this->createMapMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['map' => $map]));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|StaticMapHelper
     */
    private function createStaticMapHelperMock()
    {
        return $this->createMock(StaticMapHelper::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Map
     */
    private function createMapMock()
    {
        return $this->createMock(Map::class);
    }
}
