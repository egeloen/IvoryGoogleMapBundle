<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Overlays\Circle as BaseCircle;

/**
 * Circle entity which describes a google map circle
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle extends BaseCircle
{
    /**
     * Create a circle
     */
    public function __construct()
    {
        parent::__construct();
    }
}
