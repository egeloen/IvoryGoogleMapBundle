<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Base\Point;

/**
 * Point helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointHelper
{
    /**
     * Renders the point
     *
     * @param Ivory\GoogleMapBundle\Model\Point $point
     * @return string HTML output
     */
    public function render(Point $point)
    {
        return sprintf('new google.maps.Point(%s, %s)',
            $point->getX(),
            $point->getY()
        );
    }
}
