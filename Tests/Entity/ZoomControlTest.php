<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\ZoomControl;

/**
 * Zoom control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the zoom control constuctor
     */
    public function testConstructor()
    {
        $zoomControlEntityTest = new ZoomControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\ZoomControl', $zoomControlEntityTest);
    }
}
