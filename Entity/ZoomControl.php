<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControl as BaseZoomControl;

/**
 * Zoom control entity which describes a google map zoom control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControl extends BaseZoomControl
{
    /**
     * Create a zoom control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
