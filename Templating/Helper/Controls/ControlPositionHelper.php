<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;

/**
 * Control position helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlPositionHelper
{
    /**
     * Renders javascript control position
     *
     * @param string $controlPosition Control position
     * @return HTML output
     */
    public function render($controlPosition)
    {
        switch($controlPosition)
        {
            case ControlPosition::BOTTOM_CENTER:
                return 'google.maps.ControlPosition.BOTTOM_CENTER';
            break;

            case ControlPosition::BOTTOM_LEFT:
                return 'google.maps.ControlPosition.BOTTOM_LEFT';
            break;

            case ControlPosition::BOTTOM_RIGHT:
                return 'google.maps.ControlPosition.BOTTOM_RIGHT';
            break;

            case ControlPosition::LEFT_BOTTOM:
                return 'google.maps.ControlPosition.LEFT_BOTTOM';
            break;

            case ControlPosition::LEFT_CENTER:
                return 'google.maps.ControlPosition.LEFT_CENTER';
            break;

            case ControlPosition::LEFT_TOP:
                return 'google.maps.ControlPosition.LEFT_TOP';
            break;

            case ControlPosition::RIGHT_BOTTOM:
                return 'google.maps.ControlPosition.RIGHT_BOTTOM';
            break;

            case ControlPosition::RIGHT_CENTER:
                return 'google.maps.ControlPosition.RIGHT_CENTER';
            break;

            case ControlPosition::RIGHT_TOP:
                return 'google.maps.ControlPosition.RIGHT_TOP';
            break;

            case ControlPosition::TOP_CENTER:
                return 'google.maps.ControlPosition.TOP_CENTER';
            break;

            case ControlPosition::TOP_LEFT:
                return 'google.maps.ControlPosition.TOP_LEFT';
            break;

            case ControlPosition::TOP_RIGHT:
                return 'google.maps.ControlPosition.TOP_RIGHT';
            break;

            default:
                throw new \InvalidArgumentException('The control position is not valid.');
            break;
        }
    }
}
