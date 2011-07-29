<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Bound;
use Ivory\GoogleMapBundle\Model;

/**
 * Bound helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Construct a bound helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the bound
     *
     * @param Ivory\GoogleMapBundle\Model\Bound $bound
     * @return string HTML output
     */
    public function render(Bound $bound)
    {
        if(($bound->getSouthWest() !== null) && ($bound->getNorthEast() !== null))
            return sprintf('var %s = new google.maps.LatLngBounds(%s, %s);'.PHP_EOL,
                $bound->getJavascriptVariable(),
                $this->coordinateHelper->render($bound->getSouthWest()),
                $this->coordinateHelper->render($bound->getNorthEast())
            );
        else
            return sprintf('var %s = new google.maps.LatLngBounds();'.PHP_EOL,
                $bound->getJavascriptVariable()
            );
    }

    /**
     * Renders the bound's extend of a marker
     *
     * @param Ivory\GoogleMapBundle\Model\Bound $bound
     * @param array $elements
     * @return string HTML output
     */
    public function renderExtend(Bound $bound, $elements)
    {
        $html = array();

        foreach($elements as $element)
        {
            if(($element instanceof Model\Marker) || ($element instanceof Model\InfoWindow))
                $html[] = sprintf('%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $element->getJavascriptVariable()
                );
            else if(($element instanceof Model\Polyline) || ($element instanceof Model\Polygon))
                $html[] = sprintf('%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $element->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            else if(($element instanceof Model\Rectangle) || ($element instanceof Model\GroundOverlay))
                $html[] = sprintf('%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $element->getBound()->getJavascriptVariable()
                );
            else if($element instanceof Model\Circle)
                $html[] = sprintf('%s.extend(%s.getCenter());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $element->getJavascriptVariable()
                );
        }

        return implode('', $html);
    }
}
