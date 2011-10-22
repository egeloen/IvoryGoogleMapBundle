<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Base;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Size service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeServiceTest extends WebTestCase
{
    /**
     * Checks the size service without configuration
     */
    public function testSizeServiceWithoutConfiguration()
    {
        $size = self::createContainer()->get('ivory_google_map.size');
        
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Size', $size);
        $this->assertEquals($size->getWidth(), 1);
        $this->assertEquals($size->getHeight(), 1);
        
        $this->assertNull($size->getWidthUnit());
        $this->assertNull($size->getHeightUnit());
    }
    
    /**
     * Checks the size service with configuration
     */
    public function testSizeServiceWithConfiguration()
    {
        $size = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.size');
        
        $this->assertEquals($size->getWidth(), 100.1);
        $this->assertEquals($size->getHeight(), 200.2);
        
        $this->assertEquals($size->getWidthUnit(), 'px');
        $this->assertEquals($size->getHeightUnit(), 'pt');
    }
}
