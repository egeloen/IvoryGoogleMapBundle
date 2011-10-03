<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControl as BaseMapTypeControl;

/**
 * Map type control entity wich describes a google map type control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControl extends BaseMapTypeControl
{
    /**
     * Create a map type control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
