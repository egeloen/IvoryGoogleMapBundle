<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Base;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Bound helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * Construct a bound helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     */
    public function __construct(CoordinateHelper $coordinateHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
    }

    /**
     * Renders the bound
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound
     * @return string HTML output
     */
    public function render(Bound $bound)
    {
        $html = array();

        if($bound->hasExtends() || !$bound->hasCoordinates())
        {
            $html[] = sprintf('var %s = new google.maps.LatLngBounds();'.PHP_EOL,
                $bound->getJavascriptVariable()
            );

            if($bound->hasExtends())
                $html[] = $this->renderExtends($bound);
        }
        else
            $html[] = sprintf('var %s = new google.maps.LatLngBounds(%s, %s);'.PHP_EOL,
                $bound->getJavascriptVariable(),
                $this->coordinateHelper->render($bound->getSouthWest()),
                $this->coordinateHelper->render($bound->getNorthEast())
            );

        return implode('', $html);
    }

    /**
     * Renders the bound's extend of a marker
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound
     * @return string HTML output
     */
    public function renderExtends(Bound $bound)
    {
        $html = array();

        foreach($bound->getExtends() as $extend)
        {
            if(($extend instanceof Overlays\Marker) || ($extend instanceof Overlays\InfoWindow))
                $html[] = sprintf('%s.extend(%s.getPosition());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
            else if(($extend instanceof Overlays\Polyline) || ($extend instanceof Overlays\EncodedPolyline) || ($extend instanceof Overlays\Polygon))
                $html[] = sprintf('%s.getPath().forEach(function(element){%s.extend(element)});'.PHP_EOL,
                    $extend->getJavascriptVariable(),
                    $bound->getJavascriptVariable()
                );
            else if(($extend instanceof Overlays\Rectangle) || ($extend instanceof Overlays\GroundOverlay))
                $html[] = sprintf('%s.union(%s);'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getBound()->getJavascriptVariable()
                );
            else if($extend instanceof Overlays\Circle)
                $html[] = sprintf('%s.union(%s.getBounds());'.PHP_EOL,
                    $bound->getJavascriptVariable(),
                    $extend->getJavascriptVariable()
                );
        }

        return implode('', $html);
    }
}
