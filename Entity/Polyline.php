<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Overlays\Polyline as BasePolyline;

/**
 * Polyline entity which describes a google map polyline
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline extends BasePolyline
{
    /**
     * Create a polyline
     */
    public function __construct()
    {
        parent::__construct();
    }
}
