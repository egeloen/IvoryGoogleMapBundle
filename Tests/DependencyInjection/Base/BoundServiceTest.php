<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Base;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Bound service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundServiceTest extends WebTestCase
{
    /**
     * Checks the bound service without configuration
     */
    public function testBoundServiceWithoutConfiguration()
    {
        $bound = self::createContainer()->get('ivory_google_map.bound');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Bound', $bound);
        $this->assertEquals(substr($bound->getJavascriptVariable(), 0, 6), 'bound_');
        $this->assertFalse($bound->hasCoordinates());
        $this->assertNull($bound->getSouthWest());
        $this->assertNull($bound->getNorthEast());
    }
    
    /**
     * Checks the bound service with configuration
     */
    public function testBoundServiceWithConfiguration()
    {
        $bound = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.bound');
        
        $this->assertEquals(substr($bound->getJavascriptVariable(), 0, 1), 'b');
        $this->assertTrue($bound->hasCoordinates());
        $this->assertEquals($bound->getSouthWest()->getLatitude(), -1.1);
        $this->assertEquals($bound->getSouthWest()->getLongitude(), -2.1);
        $this->assertTrue($bound->getSouthWest()->isNoWrap());
        $this->assertEquals($bound->getNorthEast()->getLatitude(), 2.1);
        $this->assertEquals($bound->getNorthEast()->getLongitude(), 1.1);
        $this->assertFalse($bound->getNorthEast()->isNoWrap());
    }
}
