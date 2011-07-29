<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Marker;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Marker helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\InfoWindowHelper
     */
    protected $infoWindowHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\EventHelper
     */
    protected $eventHelper;

    /**
     * Constructs a marker helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper, InfoWindowHelper $infoWindowHelper, EventHelper $eventHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
        $this->infoWindowHelper = $infoWindowHelper;
        $this->eventHelper = $eventHelper;
    }
    
    /**
     * Renders the marker
     *
     * @param string $googleMapJavascriptVariable
     * @param Ivory\GoogleMapBundle\Model\Marker $marker
     * @return string HTML output
     */
    public function render(Marker $marker, Map $map)
    {
        $markerOptions = $marker->getOptions();

        if($marker->getIcon() !== null)
            $markerOptions['icon'] = $marker->getIcon();

        if($marker->getShadow() !== null)
            $markerOptions['shadow'] = $marker->getShadow();

        $markerJSONOptions = sprintf('{"map":%s,"position":%s',
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($marker->getPosition())
        );

        if(!empty($markerOptions))
            $markerJSONOptions .= ','.substr(json_encode($markerOptions), 1);
        else
            $markerJSONOptions .= '}';

        $html = array();

        $html[] = sprintf('var %s = new google.maps.Marker(%s);'.PHP_EOL,
            $marker->getJavascriptVariable(),
            $markerJSONOptions
        );

        if($marker->hasInfoWindow())
        {
            $html[] = $this->infoWindowHelper->render($marker->getInfoWindow(), false);
            
            if($marker->getInfoWindow()->isOpen())
                $html[] = $this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map);
        }

        return implode('', $html);
    }
}
