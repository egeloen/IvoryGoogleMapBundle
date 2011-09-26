<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;

use Ivory\GoogleMapBundle\Model\Overlays\Polyline;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Polyline helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Create a polyline helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Polyline $polyline
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(Polyline $polyline, Map $map)
    {
        $polylineOptions = $polyline->getOptions();

        $polylineCoordinates = array();

        foreach($polyline->getCoordinates() as $coordinate)
            $polylineCoordinates[] = $this->coordinateHelper->render($coordinate);

        $polylineJSONOptions = sprintf('{"map":%s,"path":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polylineCoordinates).']'
        );

        if(!empty($polylineOptions))
            $polylineJSONOptions .= ','.substr(json_encode($polylineOptions), 1);
        else
            $polylineJSONOptions .= '}';

        return sprintf('var %s = new google.maps.Polyline(%s);'.PHP_EOL,
            $polyline->getJavascriptVariable(),
            $polylineJSONOptions
        );
    }
}
