<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\MarkerImage;

/**
 * Marker image helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\PointHelper
     */
    protected $pointHelper = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\SizeHelper
     */
    protected $sizeHelper = null;
    
    /**
     * Create a marker image helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\PointHelper $pointHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\SizeHelper $sizeHelper 
     */
    public function __construct(PointHelper $pointHelper, SizeHelper $sizeHelper)
    {
        $this->pointHelper = $pointHelper;
        $this->sizeHelper = $sizeHelper;
    }
    
    /**
     * Renders the marker image
     *
     * @param Ivory\GoogleMapBundle\Model\MarkerImage $markerImage
     * @return string HTML output
     */
    public function render(MarkerImage $markerImage)
    {
        $html = array();
        
        $html[] = sprintf('var %s = new google.maps.MarkerImage("%s");'.PHP_EOL,
            $markerImage->getJavascriptVariable(),
            $markerImage->getUrl()
        );
        
        if($markerImage->hasSize())
            $html[] = sprintf('%s.size = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->sizeHelper->render($markerImage->getSize())
            );
        
        if($markerImage->hasOrigin())
            $html[] = sprintf('%s.origin = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->pointHelper->render($markerImage->getOrigin())
            );
        
        if($markerImage->hasAnchor())
            $html[] = sprintf('%s.anchor = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->pointHelper->render($markerImage->getAnchor())
            );
        
        if($markerImage->hasScaledSize())
            $html[] = sprintf('%s.scaledSize = %s;'.PHP_EOL,
                $markerImage->getJavascriptVariable(),
                $this->sizeHelper->render($markerImage->getScaledSize())
            );
        
        return implode('', $html);
    }
}
