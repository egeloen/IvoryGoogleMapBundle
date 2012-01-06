<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Map service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapServiceTest extends WebTestCase
{
    /**
     * Checks the map service without configuration
     */
    public function testMapServiceWithoutConfiguration()
    {
        $map = self::createContainer()->get('ivory_google_map.map');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Map', $map);
        $this->assertEquals(substr($map->getJavascriptVariable(), 0, 4), 'map_');
        $this->assertEquals($map->getHtmlContainerId(), 'map_canvas');
        $this->assertFalse($map->isAutoZoom());
        $this->assertEquals($map->getCenter()->getLatitude(), 0);
        $this->assertEquals($map->getCenter()->getLongitude(), 0);
        $this->assertTrue($map->getCenter()->isNoWrap());
        $this->assertNull($map->getBound()->getNorthEast());
        $this->assertNull($map->getBound()->getSouthWest());
        $this->assertEquals(count($map->getBound()->getExtends()), 0);
        $this->assertEquals($map->getLanguage(), 'en');
        $this->assertEquals($map->getMapOptions(), array(
            'mapTypeId' => 'roadmap',
            'zoom' => 3
        ));
        $this->assertEquals($map->getStylesheetOptions(), array(
            'width' => '300px',
            'height' => '300px'
        ));
    }
    
    /**
     * Checks the map service with configuration
     */
    public function testMapServiceWithConfiguration()
    {
        $map = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.map');
        
        $this->assertEquals(substr($map->getJavascriptVariable(), 0, 1), 'm');
        $this->assertEquals($map->getHtmlContainerId(), 'html_container_id');
        $this->assertTrue($map->isAutoZoom());
        $this->assertEquals($map->getCenter()->getLatitude(), -2.1);
        $this->assertEquals($map->getCenter()->getLongitude(), 1.1);
        $this->assertFalse($map->getCenter()->isNoWrap());
        $this->assertEquals($map->getBound()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals($map->getBound()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue($map->getBound()->getSouthWest()->isNoWrap());
        $this->assertEquals($map->getBound()->getNorthEast()->getLatitude(), 1.1);
        $this->assertEquals($map->getBound()->getNorthEast()->getLongitude(), 2.1);
        $this->assertFalse($map->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals(count($map->getBound()->getExtends()), 0);
        $this->assertEquals($map->getLanguage(), 'fr');
        $this->assertEquals($map->getMapOptions(), array(
            'mapTypeId' => 'satellite',
            'zoom' => 10,
            'option' => 'value'
        ));
        $this->assertEquals($map->getStylesheetOptions(), array(
            'width' => '100%',
            'height' => '100px',
            'option' => 'value'
        ));
    }
}
