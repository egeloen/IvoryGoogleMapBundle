<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Rectangle;

/**
 * Rectangle entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the rectangle constuctor
     */
    public function testConstructor()
    {
        $rectangleEntityTest = new Rectangle();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\Rectangle', $rectangleEntityTest);
    }
}
