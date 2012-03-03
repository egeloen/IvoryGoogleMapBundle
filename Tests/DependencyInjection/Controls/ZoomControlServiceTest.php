<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Zoom control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlServiceTest extends WebTestCase
{
    /**
     * Checks the zoom control service without configuration
     */
    public function testZoomControlServiceWithoutConfiguration()
    {
        $zoomControl = self::createContainer()->get('ivory_google_map.zoom_control');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\ZoomControl', $zoomControl);
        $this->assertEquals($zoomControl->getControlPosition(), 'top_left');
        $this->assertEquals($zoomControl->getZoomControlStyle(), 'default');
    }

    /**
     * Checks the Zoom control service with configuration
     */
    public function testZoomControlServiceWithConfiguration()
    {
        $zoomControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.zoom_control');

        $this->assertEquals($zoomControl->getControlPosition(), 'top_center');
        $this->assertEquals($zoomControl->getZoomControlStyle(), 'default');
    }
}
