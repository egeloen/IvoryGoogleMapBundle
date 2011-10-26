<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper;

use Ivory\GoogleMapBundle\Model\Overlays\InfoWindow;
use Ivory\GoogleMapBundle\Model\Overlays\Marker;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Info window helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelper
{   
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper
     */
    protected $sizeHelper = null;

    /**
     * Create an info window helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper $sizeHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper, SizeHelper $sizeHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
        $this->sizeHelper = $sizeHelper;
    }

    /**
     * Renders the info window
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\InfoWindow $infoWindow
     * @param boolean $renderPosition TRUE if the position is rendered else FALSE
     * @return string HTML output
     */
    public function render(InfoWindow $infoWindow, $renderPosition = true)
    {
        if($renderPosition)
            $infoWindowJSONOptions = sprintf('{"position":%s,',
                $this->coordinateHelper->render($infoWindow->getPosition())
            );
        else
            $infoWindowJSONOptions = '{';
        
        if($infoWindow->hasPixelOffset())
            $infoWindowJSONOptions .= '"pixelOffset":'.$this->sizeHelper->render($infoWindow->getPixelOffset()).',';
        
        $infoWindowOptions = array_merge(
            array('content' => $infoWindow->getContent()),
            $infoWindow->getOptions()
        );

        $infoWindowJSONOptions .= substr(json_encode($infoWindowOptions), 1);

        return sprintf('var %s = new google.maps.InfoWindow(%s);'.PHP_EOL,
            $infoWindow->getJavascriptVariable(),
            $infoWindowJSONOptions
        );
    }

    /**
     * Renders the info window open
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\InfoWindow $infoWindow
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @param Ivory\GoogleMapBundle\Model\Overlays\Marker $marker
     * @return string HTML output
     */
    public function renderOpen(InfoWindow $infoWindow, Map $map, Marker $marker = null)
    {
        if($marker !== null)
            return sprintf('%s.open(%s, %s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable(),
                $marker->getJavascriptVariable()
            );
        else
            return sprintf('%s.open(%s);'.PHP_EOL,
                $infoWindow->getJavascriptVariable(),
                $map->getJavascriptVariable()
            );
    }
}
