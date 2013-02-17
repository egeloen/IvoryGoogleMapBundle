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
    Ivory\GoogleMap\Controls\ZoomControlStyle,
    Ivory\GoogleMap\Controls\ZoomControl;

/**
 * Zoom control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlFactory
{
    /**
     * Creates a zoom control.
     *
     * @param string $controlPosition  The zoom control position.
     * @param string $zoomControlStyle The zoom control style.
     *
     * @return \Ivory\GoogleMap\Controls\ZoomControl The zoom control.
     */
    public function create(
        $controlPosition = ControlPosition::TOP_LEFT,
        $zoomControlStyle = ZoomControlStyle::DEFAULT_
    )
    {
        return new ZoomControl($controlPosition, $zoomControlStyle);
    }
}
