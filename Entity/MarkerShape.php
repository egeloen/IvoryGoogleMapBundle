<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\MarkerShape as BaseMarkerShape;

/**
 * Marker shape entity which describes a google map marker shape
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShape extends BaseMarkerShape
{
    /**
     * Create a marker shape
     */
    public function __construct()
    {
        parent::__construct();
    }
}
