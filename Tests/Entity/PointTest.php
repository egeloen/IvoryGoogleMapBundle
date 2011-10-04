<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Point;

/**
 * Point entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the point constuctor
     */
    public function testConstructor()
    {
        $pointEntityTest = new Point();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Point', $pointEntityTest);
    }
}
