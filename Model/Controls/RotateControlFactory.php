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
    Ivory\GoogleMap\Controls\RotateControl;

/**
 * Rotate control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlFactory
{
    /**
     * Creates a rotate control.
     *
     * @param string $controlPosition The rotate control position.
     *
     * @return \Ivory\GoogleMap\Controls\RotateControl The rotate control.
     */
    public function create($controlPosition = ControlPosition::TOP_LEFT)
    {
        return new RotateControl($controlPosition);
    }
}
