<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * Zoom control style helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleHelper
{
    /**
     * Renders javascript zoom control style
     *
     * @param string $zoomControlStyle Zoom control style
     * @return HTML output
     */
    public function render($zoomControlStyle)
    {
        switch($zoomControlStyle)
        {
            case ZoomControlStyle::DEFAULT_:
                return 'google.maps.ZoomControlStyle.DEFAULT';
            break;

            case ZoomControlStyle::LARGE:
                return 'google.maps.ZoomControlStyle.LARGE';
            break;

            case ZoomControlStyle::SMALL:
                return 'google.maps.ZoomControlStyle.SMALL';
            break;

            default:
                throw new \InvalidArgumentException('The zoom control style is not valid.');
            break;
        }
    }
}
