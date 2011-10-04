<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Marker;

/**
 * Marker entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the marker constuctor
     */
    public function testConstructor()
    {
        $markerEntityTest = new Marker();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Marker', $markerEntityTest);
    }
}
