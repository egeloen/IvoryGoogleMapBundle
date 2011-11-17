<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * TravelMode which describes the google map travel mode
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#TravelMode
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelMode 
{
    const BICYCLING = 'BICYCLING';
    const DRIVING = 'DRIVING';
    const WALKING = 'WALKING';
    
    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }
    
    /**
     * Gets the available travel modes
     *
     * @return array
     */
    public static function getTravelModes()
    {
        return array(
            self::BICYCLING,
            self::DRIVING,
            self::WALKING
        );
    }
}
