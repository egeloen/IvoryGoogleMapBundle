<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControl as BaseScaleControl;

/**
 * Scale control entity wich describes a google map scale control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControl extends BaseScaleControl
{
    /**
     * Create a scale control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
