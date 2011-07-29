<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Coordinate as BaseCoordinate;

/**
 * Coordinate entity which describes a google map coordinate
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Coordinate extends BaseCoordinate
{
    /**
     * Create a coordinate
     */
    public function __construct($latitude = 0, $longitude = 0, $noWrap = true)
    {
        parent::__construct($latitude, $longitude, $noWrap);
    }
}
