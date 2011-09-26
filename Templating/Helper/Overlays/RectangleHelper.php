<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper;

use Ivory\GoogleMapBundle\Model\Overlays\Rectangle;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Rectangle helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper
     */
    protected $boundHelper;

    /**
     * Create a rectangle helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper $boundHelper
     */
    public function __construct(BoundHelper $boundHelper)
    {
        $this->boundHelper = $boundHelper;
    }

    /**
     * Renders the rectangle
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Rectangle $rectangle
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(Rectangle $rectangle, Map $map)
    {
        $rectangleOptions = $rectangle->getOptions();

        $rectangleJSONOptions = sprintf('{"map":%s,"bounds":%s',
            $map->getJavascriptVariable(),
            $rectangle->getBound()->getJavascriptVariable()
        );

        if(!empty($rectangleOptions))
            $rectangleJSONOptions .= ','.substr(json_encode($rectangleOptions), 1);
        else
            $rectangleJSONOptions .= '}';

        $html = array();

        $html[] = $this->boundHelper->render($rectangle->getBound());
        $html[] = sprintf('var %s = new google.maps.Rectangle(%s);'.PHP_EOL,
            $rectangle->getJavascriptVariable(),
            $rectangleJSONOptions
        );

        return implode('', $html);
    }
}
