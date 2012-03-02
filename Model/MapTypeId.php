<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Map type ID which describes a google map type id
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapTypeId
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeId
{
    const HYBRID = 'hybrid';
    const ROADMAP = 'roadmap';
    const SATELLITE = 'satellite';
    const TERRAIN = 'terrain';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available map type ids
     *
     * @return array
     */
    public static function getMapTypeIds()
    {
        return array(
            self::HYBRID,
            self::ROADMAP,
            self::SATELLITE,
            self::TERRAIN
        );
    }
}
