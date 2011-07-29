<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Polygon as BasePolygon;

/**
 * Polygon entity which describes a google map polygon
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polygon extends BasePolygon
{
    /**
     * Create a polygon
     */
    public function __construct()
    {
        parent::__construct();
    }
}
