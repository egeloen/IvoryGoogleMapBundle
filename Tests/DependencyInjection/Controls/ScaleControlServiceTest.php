<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Controls;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Scale control service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlServiceTest extends WebTestCase
{
    /**
     * Checks the scale control service without configuration
     */
    public function testScaleControlServiceWithoutConfiguration()
    {
        $scaleControl = self::createContainer()->get('ivory_google_map.scale_control');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\ScaleControl', $scaleControl);
        $this->assertEquals($scaleControl->getControlPosition(), 'bottom_left');
        $this->assertEquals($scaleControl->getScaleControlStyle(), 'default');
    }

    /**
     * Checks the scale control service with configuration
     */
    public function testScaleControlServiceWithConfiguration()
    {
        $scaleControl = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.scale_control');

        $this->assertEquals($scaleControl->getControlPosition(), 'top_center');
        $this->assertEquals($scaleControl->getScaleControlStyle(), 'default');
    }
}