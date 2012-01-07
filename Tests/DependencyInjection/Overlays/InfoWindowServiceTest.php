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
        $this->assertFalse($infoWindow->hasPixelOffset());
        $this->assertNull($infoWindow->getPixelOffset());
        $this->assertFalse($infoWindow->isOpen());
        $this->assertTrue($infoWindow->isAutoOpen());
        $this->assertEquals($infoWindow->getOpenEvent(), 'click');
        $this->assertFalse($infoWindow->isAutoClose());
        $this->assertEquals(count($infoWindow->getOptions()), 0);
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
        $this->assertTrue($infoWindow->hasPixelOffset());
        $this->assertEquals($infoWindow->getPixelOffset()->getWidth(), 1.1);
        $this->assertEquals($infoWindow->getPixelOffset()->getHeight(), 2.1);
        $this->assertEquals($infoWindow->getPixelOffset()->getWidthUnit(), 'px');
        $this->assertEquals($infoWindow->getPixelOffset()->getHeightUnit(), 'pt');
        $this->assertTrue($infoWindow->isOpen());
        $this->assertFalse($infoWindow->isAutoOpen());
        $this->assertEquals($infoWindow->getOpenEvent(), 'dblclick');
        $this->assertTrue($infoWindow->isAutoClose());
        $this->assertEquals($infoWindow->getOptions(), array('option' => 'value'));
    }
}
