<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Circle service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleServiceTest extends WebTestCase
{
    /**
     * Checks the Circle service without configuration
     */
    public function testCircleServiceWithoutConfiguration()
    {
        $circle = self::createContainer()->get('ivory_google_map.circle');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Circle', $circle);
        $this->assertEquals(substr($circle->getJavascriptVariable(), 0, 7), 'circle_');
        $this->assertEquals($circle->getCenter()->getLatitude(), 0);
        $this->assertEquals($circle->getCenter()->getLongitude(), 0);
        $this->assertTrue($circle->getCenter()->isNoWrap());
        $this->assertEquals($circle->getRadius(), 1);
    }
    
    /**
     * Checks the Circle service with configuration
     */
    public function testCircleServiceWithConfiguration()
    {
        $circle = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.circle');
        
        $this->assertEquals(substr($circle->getJavascriptVariable(), 0, 1), 'c');
        $this->assertEquals($circle->getCenter()->getLatitude(), 1.1);
        $this->assertEquals($circle->getCenter()->getLongitude(), -2.1);
        $this->assertFalse($circle->getCenter()->isNoWrap());
        $this->assertEquals($circle->getRadius(), 10);
        $this->assertEquals($circle->getOptions(), array('option' => 'value'));
    }
}
