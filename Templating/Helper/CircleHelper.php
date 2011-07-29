<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Circle;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Circle helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Create a circle helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the map javascript circle
     *
     * @param Ivory\GoogleMapBundle\Model\Circle $circle
     * @param Ivory\GoogleMapBundle\Model\Map $map
     */
    public function render(Circle $circle, Map $map)
    {
        $circleOptions = array_merge(
            $circle->getOptions(),
            array('radius' => $circle->getRadius())
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
