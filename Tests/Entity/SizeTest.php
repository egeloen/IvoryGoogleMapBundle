<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Size;

/**
 * Size entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the size constuctor
     */
    public function testConstructor()
    {
        $sizeEntityTest = new Size();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Size', $sizeEntityTest);
    }
}
