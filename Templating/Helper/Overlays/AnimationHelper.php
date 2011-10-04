<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Model\Overlays\Animation;

/**
 * Animation helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationHelper 
{
    /**
     * Renders javascript animation
     *
     * @param string $animation Animation
     * @return HTML output
     */
    public function render($animation)
    {
        switch($animation)
        {
            case Animation::BOUNCE:
                return 'google.maps.Animation.BOUNCE';
            break;
        
            case Animation::DROP:
                return 'google.maps.Animation.DROP';
            break;

            default:
                throw new \InvalidArgumentException('The animation is not valid.');
            break;
        }
    }
}
