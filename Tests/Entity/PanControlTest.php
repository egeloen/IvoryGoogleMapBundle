<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\PanControl;

/**
 * Pan control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the pan control constuctor
     */
    public function testConstructor()
    {
        $panControlEntityTest = new PanControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\PanControl', $panControlEntityTest);
    }
}
