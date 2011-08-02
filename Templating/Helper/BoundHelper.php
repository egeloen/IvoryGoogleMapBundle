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
        if($bound->hasCoordinates())
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
     * @param mixed $extend
     * @return string HTML output
     */
    public function renderExtends(Bound $bound)
    {
        $html = array();

        foreach($bound->getExtends() as $extend)
        {
            if(($extend instanceof Model\Marker) || ($extend instanceof Model\InfoWindow))
                $html[] = sprintf('%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            else if(($extend instanceof Model\Polyline) || ($extend instanceof Model\Polygon))
                $html[] = sprintf('%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $extend->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            else if(($extend instanceof Model\Rectangle) || ($extend instanceof Model\GroundOverlay))
                $html[] = sprintf('%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getBound()->getJavascriptVariable()
                );
            else if($extend instanceof Model\Circle)
                $html[] = sprintf('%s.extend(%s.getCenter());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
        }

        return implode('', $html);
    }
}
