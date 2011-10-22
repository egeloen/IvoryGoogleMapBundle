<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Overview map control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlServiceTest extends WebTestCase
{
    /**
     * Checks the overview map control service without configuration
     */
    public function testOverviewMapControlServiceWithoutConfiguration()
    {
        $overviewMapControl = self::createContainer()->get('ivory_google_map.overview_map_control');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl', $overviewMapControl);
        $this->assertFalse($overviewMapControl->isOpened());
    }
    
    /**
     * Checks the overview map control service with configuration
     */
    public function testMapTypeControlServiceWithConfiguration()
    {
        $overviewMapControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.overview_map_control');
        
        $this->assertTrue($overviewMapControl->isOpened());
    }
}
