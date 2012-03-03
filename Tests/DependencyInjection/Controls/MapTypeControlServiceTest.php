<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Map type control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlServiceTest extends WebTestCase
{
    /**
     * Checks the map type control service without configuration
     */
    public function testMapTypeControlServiceWithoutConfiguration()
    {
        $mapTypeControl = self::createContainer()->get('ivory_google_map.map_type_control');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\MapTypeControl', $mapTypeControl);
        $this->assertEquals($mapTypeControl->getMapTypeIds(), array('roadmap', 'satellite'));
        $this->assertEquals($mapTypeControl->getControlPosition(), 'top_right');
        $this->assertEquals($mapTypeControl->getMapTypeControlStyle(), 'default');
    }

    /**
     * Checks the map type control service with configuration
     */
    public function testMapTypeControlServiceWithConfiguration()
    {
        $mapTypeControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.map_type_control');

        $this->assertEquals($mapTypeControl->getMapTypeIds(), array('hybrid', 'terrain'));
        $this->assertEquals($mapTypeControl->getControlPosition(), 'top_center');
        $this->assertEquals($mapTypeControl->getMapTypeControlStyle(), 'horizontal_bar');
    }
}
