<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\MarkerShape;

/**
 * Marker shape helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeHelper 
{
    /**
     * Renders the marker shape
     *
     * @param Ivory\GoogleMapBundle\Model\MarkerShape $markerShape
     * @return string HTML output
     */
    public function render(MarkerShape $markerShape)
    {
        return sprintf('var %s = %s;'.PHP_EOL,
            $markerShape->getJavascriptVariable(),
            json_encode(array(
                'type' => $markerShape->getType(),
                'coords' => $markerShape->getCoordinates()
            ))
        );
    }
}
