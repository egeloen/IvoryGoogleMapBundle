<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Pan control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlServiceTest extends WebTestCase
{
    /**
     * Checks the pan control service without configuration
     */
    public function testPanControlServiceWithoutConfiguration()
    {
        $panControl = self::createContainer()->get('ivory_google_map.pan_control');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\PanControl', $panControl);
        $this->assertEquals($panControl->getControlPosition(), 'top_left');
    }
    
    /**
     * Checks the pan control service with configuration
     */
    public function testPanControlServiceWithConfiguration()
    {
        $panControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.pan_control');
        
        $this->assertEquals($panControl->getControlPosition(), 'top_center');
    }
}
