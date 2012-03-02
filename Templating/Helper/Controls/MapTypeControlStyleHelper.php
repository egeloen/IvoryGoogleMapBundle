<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control style helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleHelper
{
    /**
     * Renders javascript map type control style
     *
     * @param string $mapTypeControlStyle Map type control style
     * @return HTML output
     */
    public function render($mapTypeControlStyle)
    {
        switch($mapTypeControlStyle)
        {
            case MapTypeControlStyle::DEFAULT_:
                return 'google.maps.MapTypeControlStyle.DEFAULT';
            break;

            case MapTypeControlStyle::DROPDOWN_MENU:
                return 'google.maps.MapTypeControlStyle.DROPDOWN_MENU';
            break;

            case MapTypeControlStyle::HORIZONTAL_BAR:
                return 'google.maps.MapTypeControlStyle.HORIZONTAL_BAR';
            break;

            default:
                throw new \InvalidArgumentException('The map type control style is not valid.');
            break;
        }
    }
}
