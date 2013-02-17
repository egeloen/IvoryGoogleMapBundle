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
    Ivory\GoogleMap\Controls\MapTypeControlStyle,
    Ivory\GoogleMap\MapTypeId,
    Ivory\GoogleMap\Controls\MapTypeControl;

/**
 * Map type control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlFactory
{
    /**
     * Creates a map type control.
     *
     * @param array  $mapTypeIds          The map type IDs.
     * @param string $controlPosition     The control position.
     * @param string $mapTypeControlStyle The map type control style.
     *
     * @return \Ivory\GoogleMap\Controls\MapTypeControl The map type control.
     */
    public function create(
        array $mapTypeIds = array(MapTypeId::ROADMAP, MapTypeId::SATELLITE),
        $controlPosition = ControlPosition::TOP_RIGHT,
        $mapTypeControlStyle = MapTypeControlStyle::DEFAULT_
    )
    {
        return new MapTypeControl($mapTypeIds, $controlPosition, $mapTypeControlStyle);
    }
}
