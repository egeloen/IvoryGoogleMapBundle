<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\MarkerShape;

/**
 * Marker shape entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the marker shape constuctor
     */
    public function testConstructor()
    {
        $markerShapeEntityTest = new MarkerShape();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\MarkerShape', $markerShapeEntityTest);
    }
}
