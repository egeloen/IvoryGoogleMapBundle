<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\MarkerImage;

/**
 * Marker image entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the marker image constuctor
     */
    public function testConstructor()
    {
        $markerImageEntityTest = new MarkerImage();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\MarkerImage', $markerImageEntityTest);
    }
}
