<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Marker service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerServiceTest extends WebTestCase
{
    /**
     * Checks the marker service without configuration
     */
    public function testMarkerServiceWithoutConfiguration()
    {
        $marker = self::createContainer()->get('ivory_google_map.marker');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Marker', $marker);
        $this->assertEquals(substr($marker->getJavascriptVariable(), 0, 7), 'marker_');
        $this->assertEquals($marker->getPosition()->getLatitude(), 0);
        $this->assertEquals($marker->getPosition()->getLongitude(), 0);
        $this->assertTrue($marker->getPosition()->isNoWrap());
        $this->assertFalse($marker->hasAnimation());
        $this->assertEmpty($marker->getOptions());
    }

    /**
     * Checks the marker service with configuration
     */
    public function testMarkerServiceWithConfiguration()
    {
        $marker = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.marker');

        $this->assertEquals(substr($marker->getJavascriptVariable(), 0, 1), 'm');
        $this->assertEquals($marker->getPosition()->getLatitude(), 1.1);
        $this->assertEquals($marker->getPosition()->getLongitude(), -2.1);
        $this->assertFalse($marker->getPosition()->isNoWrap());
        $this->assertTrue($marker->hasAnimation());
        $this->assertEquals($marker->getOptions(), array('option' => 'value'));
    }
}
