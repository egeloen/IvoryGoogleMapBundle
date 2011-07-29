<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Rectangle as BaseRectangle;

/**
 * Rectangle entity which describes a google map rectangle
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Rectangle extends BaseRectangle
{
    /**
     * Create a rectangle
     */
    public function __construct()
    {
        parent::__construct();
    }
}
