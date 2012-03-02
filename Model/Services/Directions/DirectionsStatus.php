<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * DirectionsStatus which describes the google map direction status
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsStatus
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStatus
{
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const MAX_WAYPOINTS_EXCEEDED = 'MAX_WAYPOINTS_EXCEEDED';
    const NOT_FOUND = 'NOT_FOUND';
    const OK = 'OK';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    const ZERO_RESULTS = 'ZERO_RESULTS';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available directions status
     *
     * @return array
     */
    public static function getDirectionsStatus()
    {
        return array(
            self::INVALID_REQUEST,
            self::MAX_WAYPOINTS_EXCEEDED,
            self::NOT_FOUND,
            self::OK,
            self::OVER_QUERY_LIMIT,
            self::REQUEST_DENIED,
            self::UNKNOWN_ERROR,
            self::ZERO_RESULTS
        );
    }
}
