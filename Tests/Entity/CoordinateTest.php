<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Coordinate;

/**
 * Coordinate entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the coordinate constuctor
     */
    public function testConstructor()
    {
        $coordinateEntityTest = new Coordinate();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Coordinate', $coordinateEntityTest);
    }
}
