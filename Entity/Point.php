<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Base\Point as BasePoint;

/**
 * Point entity which describes a google map point
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Point extends BasePoint
{
    /**
     * Create a point
     *
     * @param integer $x The x coordinate
     * @param integer $y The y coordinate
     */
    public function __construct($x = 0, $y = 0)
    {
        parent::__construct($x, $y);
    }
}
