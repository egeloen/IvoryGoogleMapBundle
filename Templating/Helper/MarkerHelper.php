<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Overlays\Marker;
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
     * @var Ivory\GoogleMapBundle\Templating\Helper\MarkerImageHelper
     */
    protected $markerImageHelper;
    
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\MarkerShapeHelper
     */
    protected $markerShapeHelper;

    /**
     * Constructs a marker helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\InfoWindowHelper $infoWindowHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\MarkerImageHelper $markerImageHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\MarkerShapeHelper $markerShapeHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper, InfoWindowHelper $infoWindowHelper, MarkerImageHelper $markerImageHelper, MarkerShapeHelper $markerShapeHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
        $this->infoWindowHelper = $infoWindowHelper;
        $this->markerImageHelper = $markerImageHelper;
        $this->markerShapeHelper = $markerShapeHelper;
    }
    
    /**
     * Renders the marker
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Marker $marker
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(Marker $marker, Map $map)
    {
        $html = array();
        
        $markerJSONOptions = sprintf('{"map":%s,"position":%s',
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($marker->getPosition())
        );
        
        $markerOptions = $marker->getOptions();

        if($marker->hasIcon())
        {
            $html[] = $this->markerImageHelper->render($marker->getIcon());
            $markerJSONOptions .= ', "icon":'.$marker->getIcon()->getJavascriptVariable();
        }

        if($marker->hasShadow())
        {
            $html[] = $this->markerImageHelper->render($marker->getShadow());
            $markerJSONOptions .= ', "shadow":'.$marker->getShadow()->getJavascriptVariable();
        }
        
        if($marker->hasShape())
        {
            $html[] = $this->markerShapeHelper->render($marker->getShape());
            $markerJSONOptions .= ', "shape":'.$marker->getShape()->getJavascriptVariable();
        }

        if(!empty($markerOptions))
            $markerJSONOptions .= ','.substr(json_encode($markerOptions), 1);
        else
            $markerJSONOptions .= '}';

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
