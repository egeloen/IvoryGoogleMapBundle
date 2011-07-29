<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\InfoWindow as BaseInfoWindow;

/**
 * Info window entity which describes a google map info window
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends BaseInfoWindow
{
    /**
     * Create an info window
     */
    public function __construct()
    {
        parent::__construct();
    }
}
