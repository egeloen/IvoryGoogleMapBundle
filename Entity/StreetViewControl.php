<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\StreetViewControl as BaseStreetViewControl;

/**
 * Street view control entity wich describes a google map street view control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControl extends BaseStreetViewControl
{
    /**
     * Create a street view control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
