<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Overlays\GroundOverlay;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Ground overlay helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\BoundHelper
     */
    protected $boundHelper;
    
    /**
     * Create a ground overlay helper
     *
     * @param Ivory\GoogleMapBundle\templating\Helper\BoundHelper $boundHelper 
     */
    public function __construct(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Renders the map javascript ground overlay
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\GroundOverlay $groundOverlay
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(GroundOverlay $groundOverlay, Map $map)
    {
        $groundOverlayOptions = $groundOverlay->getOptions();

        $groundOverlayJSONOptions = sprintf('{"map":%s',
            $map->getJavascriptVariable()
        );

        if(!empty($groundOverlayOptions))
            $groundOverlayJSONOptions .= ','.substr(json_encode($groundOverlayOptions), 1);
        else
            $groundOverlayJSONOptions .= '}';

        $html = array();

        $html[] = $this->boundHelper->render($groundOverlay->getBound());
        $html[] = sprintf('var %s = new google.maps.GroundOverlay("%s", %s, %s);'.PHP_EOL,
            $groundOverlay->getJavascriptVariable(),
            $groundOverlay->getUrl(),
            $groundOverlay->getBound()->getJavascriptVariable(),
            $groundOverlayJSONOptions
        );

        return implode('', $html);
    }
}
