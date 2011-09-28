<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;

use Ivory\GoogleMapBundle\Model\Overlays\Circle;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Circle helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Create a circle helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the map javascript circle
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Circle $circle
     * @param Ivory\GoogleMapBundle\Model\Map $map
     */
    public function render(Circle $circle, Map $map)
    {
        $circleOptions = array_merge(
            array('radius' => $circle->getRadius()),
            $circle->getOptions()
        );

        $circleJSONOptions = sprintf('{"map":%s,"center":%s,',
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($circle->getCenter())
        );

        $circleJSONOptions .= substr(json_encode($circleOptions), 1);

        return sprintf('var %s = new google.maps.Circle(%s);'.PHP_EOL,
            $circle->getJavascriptVariable(),
            $circleJSONOptions
        );
    }
}
