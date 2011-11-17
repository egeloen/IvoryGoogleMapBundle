<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

/**
 * Geocoder status which describes a google map geocoder status
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderStatus 
{
    const ERROR = 'ERROR';
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const ZERO_RESULTS = 'ZERO_RESULTS';
    
    /**
     * Gets the available geocoder status
     *
     * @return array
     */
    public static function getGeocoderStatus()
    {
        return array(
            self::ERROR,
            self::INVALID_REQUEST,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::UNKNOWN_ERROR,
            self::ZERO_RESULTS
        );
    }
}
