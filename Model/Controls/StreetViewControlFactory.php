<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Controls;

use Ivory\GoogleMap\Controls\ControlPosition,
    Ivory\GoogleMap\Controls\StreetViewControl;

/**
 * Street view control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlFactory
{
    /**
     * Creates a street view control.
     *
     * @param string $controlPosition The control position.
     *
     * @return \Ivory\GoogleMap\Controls\StreetViewControl The street view control.
     */
    public function create($controlPosition = ControlPosition::TOP_LEFT)
    {
        return new StreetViewControl($controlPosition);
    }
}
