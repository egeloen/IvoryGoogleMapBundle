<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoder;

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
