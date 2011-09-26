<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Overlays\MarkerImage as BaseMarkerImage;

/**
 * Marker image entity which describes a google map marker image
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImage extends BaseMarkerImage
{
    /**
     * Create a marker image
     */
    public function __construct()
    {
        parent::__construct();
    }
}
