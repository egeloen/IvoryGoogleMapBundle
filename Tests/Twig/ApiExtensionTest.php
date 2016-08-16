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

use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMapBundle\Twig\ApiExtension;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiExtensionTest extends AbstractExtensionTest
{
    /**
     * @var ApiHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    private $apiHelper;

    /**
     * {@inheritdoc}
     */
    protected function createExtension()
    {
        $this->apiHelper = $this->createApiHelperMock();

        return new ApiExtension($this->apiHelper);
    }

    public function testRender()
    {
        $template = $this->getTwig()->createTemplate('{{ ivory_google_api([object]) }}');

        $this->apiHelper
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo([$object = new \stdClass()]))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $template->render(['object' => $object]));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ApiHelper
     */
    private function createApiHelperMock()
    {
        return $this->createMock(ApiHelper::class);
    }
}
