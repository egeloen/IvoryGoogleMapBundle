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
        $this->assertEquals($markerImage->getUrl(), 'http://maps.gstatic.com/mapfiles/markers/marker.png');
        
        $this->assertFalse($markerImage->hasAnchor());
        $this->assertNull($markerImage->getAnchor());
        
        $this->assertFalse($markerImage->hasOrigin());
        $this->assertNull($markerImage->getOrigin());
        
        $this->assertFalse($markerImage->hasScaledSize());
        $this->assertNull($markerImage->getScaledSize());
        
        $this->assertFalse($markerImage->hasSize());
        $this->assertNull($markerImage->getSize());
    }
    
    /**
     * Checks the  marker image service with configuration
     */
    public function testMarkerImageServiceWithConfiguration()
    {
        $markerImage = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.marker_image');
        
        $this->assertEquals(substr($markerImage->getJavascriptVariable(), 0, 2), 'mi');
        $this->assertEquals($markerImage->getUrl(), 'url');
        
        $this->assertTrue($markerImage->hasAnchor());
        $this->assertEquals($markerImage->getAnchor()->getX(), 1.1);
        $this->assertEquals($markerImage->getAnchor()->getY(), 2.1);
        
        $this->assertTrue($markerImage->hasOrigin());
        $this->assertEquals($markerImage->getOrigin()->getX(), 2.1);
        $this->assertEquals($markerImage->getOrigin()->getY(), 1.1);
        
        $this->assertTrue($markerImage->hasScaledSize());
        $this->assertEquals($markerImage->getScaledSize()->getWidth(), 16);
        $this->assertEquals($markerImage->getScaledSize()->getHeight(), 19);
        $this->assertEquals($markerImage->getScaledSize()->getWidthUnit(), "px");
        $this->assertEquals($markerImage->getScaledSize()->getHeightUnit(), "pt");
        
        $this->assertTrue($markerImage->hasSize());
        $this->assertEquals($markerImage->getSize()->getWidth(), 20);
        $this->assertEquals($markerImage->getSize()->getHeight(), 22);
        $this->assertEquals($markerImage->getSize()->getWidthUnit(), "px");
        $this->assertEquals($markerImage->getSize()->getHeightUnit(), "pt");
    }
}
