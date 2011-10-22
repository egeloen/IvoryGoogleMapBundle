<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Rectangle service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleServiceTest extends WebTestCase
{
    /**
     * Checks the rectangle service without configuration
     */
    public function testRectangleServiceWithoutConfiguration()
    {
        $rectangle = self::createContainer()->get('ivory_google_map.rectangle');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Rectangle', $rectangle);
        $this->assertEquals(substr($rectangle->getJavascriptVariable(), 0, 10), 'rectangle_');
        $this->assertEquals($rectangle->getBound()->getNorthEast()->getLatitude(), 1);
        $this->assertEquals($rectangle->getBound()->getNorthEast()->getLongitude(), 1);
        $this->assertTrue($rectangle->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals($rectangle->getBound()->getSouthWest()->getLatitude(), -1);
        $this->assertEquals($rectangle->getBound()->getSouthWest()->getLongitude(), -1);
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());
    }
    
    /**
     * Checks the rectangle service with configuration
     */
    public function testRectangleServiceWithConfiguration()
    {
        $rectangle = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.rectangle');
        
        $this->assertEquals(substr($rectangle->getJavascriptVariable(), 0, 1), 'r');
        $this->assertEquals($rectangle->getBound()->getNorthEast()->getLatitude(), 1.1);
        $this->assertEquals($rectangle->getBound()->getNorthEast()->getLongitude(), 2.1);
        $this->assertFalse($rectangle->getBound()->getNorthEast()->isNoWrap());
        $this->assertEquals($rectangle->getBound()->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals($rectangle->getBound()->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue($rectangle->getBound()->getSouthWest()->isNoWrap());
    }
}
