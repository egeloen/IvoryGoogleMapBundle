<?php

namespace Ivory\GoogleMapBundle\Model\Events;

/**
 * Mouse event describes the google map mouse event
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MouseEvent
{
    const CLICK = 'click';
    const DBLCLICK = 'dblclick';
    const MOUSEUP = 'mouseup';
    const MOUSEDOWN = 'mousedown';
    const MOUSEOVER = 'mouseover';
    const MOUSEOUT = 'mouseout';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available mouse events
     *
     * @return array
     */
    public static function getMouseEvents()
    {
        return array(
            self::CLICK,
            self::DBLCLICK,
            self::MOUSEUP,
            self::MOUSEDOWN,
            self::MOUSEOVER,
            self::MOUSEOUT
        );
    }
}
