<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

/**
 * GeocoderLocationType which describes a google map geocoder location type
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderLocationType
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderLocationType 
{
    const APPROXIMATE = 'APPROXIMATE';
    const GEOMETRIC_CENTER = 'GEOMETRIC_CENTER';
    const RANGE_INTERPOLATED = 'RANGE_INTERPOLATED';
    const ROOFTOP = 'ROOFTOP';
    
    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }
    
    /**
     * Gets the available geocoder location types
     *
     * @return array
     */
    public static function getGeocoderLocationTypes()
    {
        return array(
            self::APPROXIMATE,
            self::GEOMETRIC_CENTER,
            self::RANGE_INTERPOLATED,
            self::ROOFTOP
        );
    }
}
