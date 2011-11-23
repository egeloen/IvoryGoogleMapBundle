<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Encoded polyline service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineServiceTest extends WebTestCase
{
    /**
     * Checks the encoded polyline service without configuration
     */
    public function testEncodedPolylineServiceWithoutConfiguration()
    {
        $encodedPolyline = self::createContainer()->get('ivory_google_map.encoded_polyline');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline', $encodedPolyline);
        $this->assertEquals(substr($encodedPolyline->getJavascriptVariable(), 0, 17), 'encoded_polyline_');
    }
    
    /**
     * Checks the encoded polyline service with configuration
     */
    public function testEncodedPolylineServiceWithConfiguration()
    {
        $encodedPolyline = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.encoded_polyline');
        
        $this->assertEquals(substr($encodedPolyline->getJavascriptVariable(), 0, 2), 'ep');
        $this->assertEquals($encodedPolyline->getOptions(), array('option' => 'value'));
    }
}
