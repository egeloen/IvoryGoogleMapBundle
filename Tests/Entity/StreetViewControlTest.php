<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\StreetViewControl;

/**
 * Street view control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the street view control constuctor
     */
    public function testConstructor()
    {
        $streetViewControlEntityTest = new StreetViewControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\StreetViewControl', $streetViewControlEntityTest);
    }
}
