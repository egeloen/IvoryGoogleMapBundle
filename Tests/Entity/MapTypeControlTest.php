<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\MapTypeControl;

/**
 * Map type control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the map type control constuctor
     */
    public function testConstructor()
    {
        $mapTypeControlEntityTest = new MapTypeControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\MapTypeControl', $mapTypeControlEntityTest);
    }
}
