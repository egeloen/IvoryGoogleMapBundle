<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Ground overlay service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayServiceTest extends WebTestCase
{
    /**
     * Checks the ground overlay service without configuration
     */
    public function testGroundOverlayServiceWithoutConfiguration()
    {
        $groundOverlay = self::createContainer()->get('ivory_google_map.ground_overlay');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\GroundOverlay', $groundOverlay);
        $this->assertEquals(substr($groundOverlay->getJavascriptVariable(), 0, 15), 'ground_overlay_');
        $this->assertEquals($groundOverlay->getUrl(), '');
        $this->assertEquals($groundOverlay->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals($groundOverlay->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue($groundOverlay->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals($groundOverlay->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals($groundOverlay->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());
    }

    /**
     * Checks the ground overlay service with configuration
     */
    public function testGroundOverlayServiceWithConfiguration()
    {
        $groundOverlay = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.ground_overlay');

        $this->assertEquals(substr($groundOverlay->getJavascriptVariable(), 0, 2), 'go');
        $this->assertEquals($groundOverlay->getUrl(), 'url');
        $this->assertEquals($groundOverlay->getBound()->getNorthEast()->getLatitude(), 1.1);
        $this->assertEquals($groundOverlay->getBound()->getNorthEast()->getLongitude(), 2.1);
        $this->assertFalse($groundOverlay->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals($groundOverlay->getBound()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals($groundOverlay->getBound()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue($groundOverlay->getBound()->getSouthWest()->isNoWrap());
    }
}
