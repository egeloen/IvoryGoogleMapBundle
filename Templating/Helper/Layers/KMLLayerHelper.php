<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Layers;

use Ivory\GoogleMapBundle\Model\Layers\KMLLayer;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * KML Layer helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerHelper
{
    /**
     * Renders the map javascript kml layer
     *
     * @param Ivory\GoogleMapBundle\Model\Layers\KMLLayer $kmlLayer The KML layer
     * @param Ivory\GoogleMapBundle\Model\Map $map The map
     */
    public function render(KMLLayer $kmlLayer, Map $map)
    {
        $kmlLayerOptions = $kmlLayer->getOptions();

        $kmlLayerJSONOptions = sprintf('{"map":%s',
            $map->getJavascriptVariable()
        );

        if(!empty($kmlLayerOptions))
            $kmlLayerJSONOptions .= ','.substr(json_encode($kmlLayerOptions), 1);
        else
            $kmlLayerJSONOptions .= '}';


        return sprintf('var %s = new google.maps.KmlLayer("%s", %s);'.PHP_EOL,
            $kmlLayer->getJavascriptVariable(),
            $kmlLayer->getUrl(),
            $kmlLayerJSONOptions
        );
    }
}
