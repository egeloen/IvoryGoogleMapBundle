<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Base\Size as BaseSize;

/**
 * Size entity which describes a google map size
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Size extends BaseSize
{
    /**
     * Create a size
     */
    public function __construct($width = 1, $height = 1, $widthUnit = null, $heightUnit = null)
    {
        parent::__construct($width, $height, $widthUnit, $heightUnit);
    }
}
