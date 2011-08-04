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
        $html = sprintf('var %s = new google.maps.MarkerImage("%s"',
            $markerImage->getJavascriptVariable(),
            $markerImage->getUrl()
        );
        
        if($markerImage->hasSize())
            $html .= ', '.$this->sizeHelper->render($markerImage->getSize());
        
        if($markerImage->hasOrigin())
            $html .= ', '.$this->pointHelper->render($markerImage->getOrigin());
        
        if($markerImage->hasAnchor())
            $html .= ', '.$this->pointHelper->render($markerImage->getAnchor());
        
        if($markerImage->hasScaledSize())
            $html .= ', '.$this->sizeHelper->render($markerImage->getScaledSize());
        
        $html .= ');'.PHP_EOL;
        
        return $html;
    }
}
