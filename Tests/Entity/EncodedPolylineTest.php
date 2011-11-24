<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\EncodedPolyline;

/**
 * Encoded Polyline Test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the encoded polyline constuctor
     */
    public function testConstructor()
    {
        $encodedPolylineEntityTest = new EncodedPolyline();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline', $encodedPolylineEntityTest);
    }
}
