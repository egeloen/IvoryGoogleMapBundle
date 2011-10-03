<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl as BaseOverviewMapControl;

/**
 * Overview map control entity wich describes a google map overview control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControl extends BaseOverviewMapControl
{
    /**
     * Create an overview map control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
