<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * Coordinate factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateFactory
{
    /**
     * Creates a coordinate.
     *
     * @param integer $latitude  The latitude.
     * @param integer $longitude The longitude.
     * @param boolean $noWrap    The no wrap flag.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The coordinate.
     */
    public function create($latitude = 0, $longitude = 0, $noWrap = true)
    {
        return new Coordinate($latitude, $longitude, $noWrap);
    }
}
