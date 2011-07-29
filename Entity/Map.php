<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Map as BaseMap;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Map entity wich describes a google map
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends BaseMap
{
    /**
     * Create a map
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Action performed before database persist
     */
    public function prePersist()
    {
        if($this->isAutoZoom())
            unset($this->center);
        else
            unset($this->bound);
    }
}
