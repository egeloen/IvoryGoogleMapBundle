<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline as BaseEncodedPolyline;

/**
 * Encoded Polyline Entity
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolyline extends BaseEncodedPolyline
{
    /**
     * Create an encoded polyline
     *
     * @param string $value
     */
    public function __construct($value = null)
    {
        parent::__construct($value);
    }
}
