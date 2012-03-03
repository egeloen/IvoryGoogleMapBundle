<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Rotate control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlServiceTest extends WebTestCase
{
    /**
     * Checks the rotate control service without configuration
     */
    public function testRotateControlServiceWithoutConfiguration()
    {
        $rotateControl = self::createContainer()->get('ivory_google_map.rotate_control');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\RotateControl', $rotateControl);
        $this->assertEquals($rotateControl->getControlPosition(), 'top_left');
    }

    /**
     * Checks the rotate control service with configuration
     */
    public function testRotateControlServiceWithConfiguration()
    {
        $rotateControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.rotate_control');

        $this->assertEquals($rotateControl->getControlPosition(), 'top_center');
    }
}