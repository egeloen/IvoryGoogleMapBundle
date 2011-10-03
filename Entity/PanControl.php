<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\PanControl as BasePanControl;

/**
 * Pan control entity wich describes a google map pan control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControl extends BasePanControl
{
    /**
     * Create a pan control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
