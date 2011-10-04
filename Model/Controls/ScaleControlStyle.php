<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * Scale control style which describes a google map scale control style
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlStyle
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyle
{
    const DEFAULT_ = 'default';
    
    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }
    
    /**
     * Gets the available map scale control styles
     *
     * @return array
     */
    public static function getScaleControlStyles()
    {
        return array(
            self::DEFAULT_
        );
    }
}
