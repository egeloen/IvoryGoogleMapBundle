<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Polyline;

/**
 * Polyline entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the polyline constuctor
     */
    public function testConstructor()
    {
        $polylineEntityTest = new Polyline();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Polyline', $polylineEntityTest);
    }
}
