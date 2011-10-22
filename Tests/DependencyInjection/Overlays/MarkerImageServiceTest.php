<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Marker image service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageServiceTest extends WebTestCase
{
    /**
     * Checks the marker image service without configuration
     */
    public function testMarkerImageServiceWithoutConfiguration()
    {
        $markerImage = self::createContainer()->get('ivory_google_map.marker_image');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\MarkerImage', $markerImage);
        $this->assertEquals(substr($markerImage->getJavascriptVariable(), 0, 13), 'marker_image_');
        $this->assertEquals($markerImage->getUrl(), '');
    }
    
    /**
     * Checks the  marker image service with configuration
     */
    public function testMarkerImageServiceWithConfiguration()
    {
        $markerImage = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.marker_image');
        
        $this->assertEquals(substr($markerImage->getJavascriptVariable(), 0, 2), 'mi');
        $this->assertEquals($markerImage->getUrl(), 'url');
    }
}
