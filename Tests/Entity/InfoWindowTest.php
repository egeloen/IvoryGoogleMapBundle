<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\InfoWindow;

/**
 * Info window entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the info window constuctor
     */
    public function testConstructor()
    {
        $infoWindowEntityTest = new InfoWindow();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\InfoWindow', $infoWindowEntityTest);
    }
}
