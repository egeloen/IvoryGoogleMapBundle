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

use Ivory\GoogleMap\Base\Point;

/**
 * Point factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointFactory
{
    /**
     * Create a point.
     *
     * @param double $x The x coordinate.
     * @param double $y The y coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Point The point.
     */
    public function create($x = 0, $y = 0)
    {
        return new Point($x, $y);
    }
}
