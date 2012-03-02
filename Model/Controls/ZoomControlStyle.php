<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * Zoom control style which describes a google map zoom control style
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlStyle
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyle
{
    const DEFAULT_ = 'default';
    const LARGE = 'large';
    const SMALL = 'small';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available map zoom control styles
     *
     * @return array
     */
    public static function getZoomControlStyles()
    {
        return array(
            self::DEFAULT_,
            self::LARGE,
            self::SMALL
        );
    }
}
