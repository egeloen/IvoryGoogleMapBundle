<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Polygon;

/**
 * Polygon entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the polygon constuctor
     */
    public function testConstructor()
    {
        $polygonEntityTest = new Polygon();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Polygon', $polygonEntityTest);
    }
}
