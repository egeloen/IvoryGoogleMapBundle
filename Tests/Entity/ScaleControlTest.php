<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\ScaleControl;

/**
 * Scale control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the scale control constuctor
     */
    public function testConstructor()
    {
        $scaleControlEntityTest = new ScaleControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\ScaleControl', $scaleControlEntityTest);
    }
}
