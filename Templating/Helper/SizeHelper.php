<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Size helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeHelper
{
    /**
     * Renders the size
     *
     * @param Ivory\GoogleMapBundle\Model\Size $size
     * @return string HTML output
     */
    public function render(Size $size)
    {
        if($size->hasUnits())
            return sprintf('new google.maps.Size(%s, %s, "%s", "%s")',
                $size->getWidth(),
                $size->getHeight(),
                $size->getWidthUnit(),
                $size->getHeightUnit()
            );
        else
            return sprintf('new google.maps.Size(%s, %s)',
                $size->getWidth(),
                $size->getHeight()
            );
    }
}
