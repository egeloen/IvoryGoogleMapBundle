<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * Map type control style which describes a google map type control style
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ControlPosition
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyle
{
    const DEFAULT_ = 'default';
    const DROPDOWN_MENU = 'dropdown_menu';
    const HORIZONTAL_BAR = 'horizontal_bar';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available map type control styles
     *
     * @return array
     */
    public static function getMapTypeControlStyles()
    {
        return array(
            self::DEFAULT_,
            self::DROPDOWN_MENU,
            self::HORIZONTAL_BAR
        );
    }
}
