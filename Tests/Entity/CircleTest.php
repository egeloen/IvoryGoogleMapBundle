<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Circle;

/**
 * Circle entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the circle constuctor
     */
    public function testConstructor()
    {
        $circleEntityTest = new Circle();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Circle', $circleEntityTest);
    }
}
