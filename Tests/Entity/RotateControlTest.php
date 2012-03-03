<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\RotateControl;

/**
 * Rotate control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the rotate control constuctor
     */
    public function testConstructor()
    {
        $rotateControlEntityTest = new RotateControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\RotateControl', $rotateControlEntityTest);
    }
}
