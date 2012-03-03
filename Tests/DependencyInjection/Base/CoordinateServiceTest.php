<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Base;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Coordinate service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateServiceTest extends WebTestCase
{
    /**
     * Checks the coordinate service without configuration
     */
    public function testCoordinateServiceWithoutConfiguration()
    {
        $coordinate = self::createContainer()->get('ivory_google_map.coordinate');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Coordinate', $coordinate);
        $this->assertEquals($coordinate->getLatitude(), 0);
        $this->assertEquals($coordinate->getLongitude(), 0);
        $this->assertTrue($coordinate->isNoWrap());
    }

    /**
     * Checks the coordinate service with configuration
     */
    public function testCoordinateServiceWithConfiguration()
    {
        $coordinate = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.coordinate');

        $this->assertEquals($coordinate->getLatitude(), 1.1);
        $this->assertEquals($coordinate->getLongitude(), -2.1);
        $this->assertFalse($coordinate->isNoWrap());
    }
}
