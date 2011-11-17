<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * UnitSystem which describes the google map unit system
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#UnitSystem
 * @author GeLo <geloen.eric@gmail.com>
 */
class UnitSystem 
{
    const IMPERIAL = 'IMPERIAL';
    const METRIC = 'METRIC';
    
    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }
    
    /**
     * Gets the available unit systems
     *
     * @return array
     */
    public static function getUnitSystems()
    {
        return array(
            self::IMPERIAL,
            self::METRIC
        );
    }
}
