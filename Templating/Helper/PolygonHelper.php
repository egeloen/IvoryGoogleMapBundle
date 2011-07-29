<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Polygon;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Polygon helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Create a polygon helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the polygon
     *
     * @param Ivory\GoogleMapBundle\Model\Polygon $polygon
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(Polygon $polygon, Map $map)
    {
        $polygonOptions = $polygon->getOptions();

        $polygonCoordinates = array();

        foreach($polygon->getCoordinates() as $coordinate)
            $polygonCoordinates[] = $this->coordinateHelper->render($coordinate);

        $polygonJSONOptions = sprintf('{"map":%s,"paths":%s',
            $map->getJavascriptVariable(),
            '['.implode(',', $polygonCoordinates).']'
        );

        if(!empty($polygonOptions))
            $polygonJSONOptions .= ','.substr(json_encode($polygonOptions), 1);
        else
            $polygonJSONOptions .= '}';

        return sprintf('var %s = new google.maps.Polygon(%s);'.PHP_EOL,
            $polygon->getJavascriptVariable(),
            $polygonJSONOptions
        );
    }
}
