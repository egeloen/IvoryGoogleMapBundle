<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control style helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleHelper
{
    /**
     * Renders javascript scale control style
     *
     * @param string $scaleControlStyle Scale control style
     * @return HTML output
     */
    public function render($scaleControlStyle)
    {
        switch($scaleControlStyle)
        {
            case ScaleControlStyle::DEFAULT_:
                return 'google.maps.ScaleControlStyle.DEFAULT';
            break;

            default:
                throw new \InvalidArgumentException('The scale control style is not valid.');
            break;
        }
    }
}
