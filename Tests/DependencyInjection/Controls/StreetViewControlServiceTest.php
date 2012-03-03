<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Street view control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlServiceTest extends WebTestCase
{
    /**
     * Checks the street view control service without configuration
     */
    public function testStreetViewControlServiceWithoutConfiguration()
    {
        $streetViewControl = self::createContainer()->get('ivory_google_map.street_view_control');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\StreetViewControl', $streetViewControl);
        $this->assertEquals($streetViewControl->getControlPosition(), 'top_left');
    }

    /**
     * Checks the StreetView control service with configuration
     */
    public function testStreetViewControlServiceWithConfiguration()
    {
        $streetViewControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.street_view_control');

        $this->assertEquals($streetViewControl->getControlPosition(), 'top_center');
    }
}