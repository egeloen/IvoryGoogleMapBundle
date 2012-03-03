<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Base;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Point service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointServiceTest extends WebTestCase
{
    /**
     * Checks the point service without configuration
     */
    public function testPointServiceWithoutConfiguration()
    {
        $point = self::createContainer()->get('ivory_google_map.point');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Point', $point);
        $this->assertEquals($point->getX(), 0);
        $this->assertEquals($point->getY(), 0);
    }

    /**
     * Checks the point service with configuration
     */
    public function testPointServiceWithConfiguration()
    {
        $point = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.point');

        $this->assertEquals($point->getX(), 1.1);
        $this->assertEquals($point->getY(), -2.1);
    }
}
