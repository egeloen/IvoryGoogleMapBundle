<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Marker as BaseMarker;

/**
 * Marker entity which describes a google map marker
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends BaseMarker
{
    /**
     * Create a marker
     */
    public function __construct()
    {
        parent::__construct();
    }
}
