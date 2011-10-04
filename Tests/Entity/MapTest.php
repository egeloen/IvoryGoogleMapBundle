<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Map;

/**
 * Map entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the map constuctor
     */
    public function testConstructor()
    {
        $mapEntityTest = new Map();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Map', $mapEntityTest);
    }
}
