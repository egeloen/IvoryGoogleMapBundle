<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Info window service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowServiceTest extends WebTestCase
{
    /**
     * Checks the info window service without configuration
     */
    public function testInfoWindowServiceWithoutConfiguration()
    {
        $infoWindow = self::createContainer()->get('ivory_google_map.info_window');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\InfoWindow', $infoWindow);
        $this->assertEquals(substr($infoWindow->getJavascriptVariable(), 0, 12), 'info_window_');
        $this->assertEquals($infoWindow->getPosition()->getLatitude(), 0);
        $this->assertEquals($infoWindow->getPosition()->getLongitude(), 0);
        $this->assertTrue($infoWindow->getPosition()->isNoWrap());
        $this->assertEquals($infoWindow->getContent(), '<p>Default content</p>');
        $this->assertTrue($infoWindow->isOpen());
    }
    
    /**
     * Checks the info window service with configuration
     */
    public function testInfoWindowServiceWithConfiguration()
    {
        $infoWindow = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.info_window');
        
        $this->assertEquals(substr($infoWindow->getJavascriptVariable(), 0, 2), 'iw');
        $this->assertEquals($infoWindow->getPosition()->getLatitude(), 1.1);
        $this->assertEquals($infoWindow->getPosition()->getLongitude(), -2.1);
        $this->assertFalse($infoWindow->getPosition()->isNoWrap());
        $this->assertEquals($infoWindow->getContent(), '<div class="info_window"></div>');
        $this->assertEquals($infoWindow->getOptions(), array('option' => 'value'));
        $this->assertFalse($infoWindow->isOpen());
    }
}
