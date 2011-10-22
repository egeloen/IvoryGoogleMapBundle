<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Polygon service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonServiceTest extends WebTestCase
{
    /**
     * Checks the polygon service without configuration
     */
    public function testpolygonServiceWithoutConfiguration()
    {
        $polygon = self::createContainer()->get('ivory_google_map.polygon');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Polygon', $polygon);
        $this->assertEquals(substr($polygon->getJavascriptVariable(), 0, 8), 'polygon_');
    }
    
    /**
     * Checks the polygon service with configuration
     */
    public function testPolygonServiceWithConfiguration()
    {
        $polygon = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.polygon');
        
        $this->assertEquals(substr($polygon->getJavascriptVariable(), 0, 1), 'p');
        $this->assertEquals($polygon->getOptions(), array('option' => 'value'));
    }
}
