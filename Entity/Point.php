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
     */
    public function __construct($x = 0, $y = 0)
    {
        parent::__construct($x, $y);
    }
}
