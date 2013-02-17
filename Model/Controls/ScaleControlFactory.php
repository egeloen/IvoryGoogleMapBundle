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
    Ivory\GoogleMap\Controls\ScaleControlStyle,
    Ivory\GoogleMap\Controls\ScaleControl;

/**
 * Scale control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlFactory
{
    /**
     * Creates a scale control.
     *
     * @param string $controlPosition   The control position.
     * @param string $scaleControlStyle The scale control style.
     *
     * @return \Ivory\GoogleMap\Controls\ScaleControl The scale control.
     */
    public function create(
        $controlPosition = ControlPosition::BOTTOM_LEFT,
        $scaleControlStyle = ScaleControlStyle::DEFAULT_
    )
    {
        return new ScaleControl($controlPosition, $scaleControlStyle);
    }
}
