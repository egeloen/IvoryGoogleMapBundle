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
    Ivory\GoogleMap\Controls\PanControl;

/**
 * Pan control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlFactory
{
    /**
     * Creates a pan control.
     *
     * @param string $controlPosition The pan control position.
     *
     * @return \Ivory\GoogleMap\Controls\PanControl The pan control.
     */
    public function create($controlPosition = ControlPosition::TOP_LEFT)
    {
        return new PanControl($controlPosition);
    }
}
