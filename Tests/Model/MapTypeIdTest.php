<?php

namespace Ivory\GoogleMapBundle\Tests\Model;

use Ivory\GoogleMapBundle\Model\MapTypeId;

/**
 * Map type ID test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the map type ids getter
     */
    public function testMapTypeIds()
    {
        $this->assertEquals(MapTypeId::getMapTypeIds(), array(
            MapTypeId::HYBRID,
            MapTypeId::ROADMAP,
            MapTypeId::SATELLITE,
            MapTypeId::TERRAIN
        ));
    }
}
