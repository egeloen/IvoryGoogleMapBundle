<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Polyline service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineServiceTest extends WebTestCase
{
    /**
     * Checks the polyline service without configuration
     */
    public function testpolylineServiceWithoutConfiguration()
    {
        $polyline = self::createContainer()->get('ivory_google_map.polyline');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Polyline', $polyline);
        $this->assertEquals(substr($polyline->getJavascriptVariable(), 0, 9), 'polyline_');
    }
    
    /**
     * Checks the polyline service with configuration
     */
    public function testPolylineServiceWithConfiguration()
    {
        $polyline = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.polyline');
        
        $this->assertEquals(substr($polyline->getJavascriptVariable(), 0, 1), 'p');
        $this->assertEquals($polyline->getOptions(), array('option' => 'value'));
    }
}
