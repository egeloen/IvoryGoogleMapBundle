<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Bound;

/**
 * Bound entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the bound constuctor
     */
    public function testConstructor()
    {
        $boundEntityTest = new Bound();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Base\Bound', $boundEntityTest);
    }
}
