<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\AbstractService;

/**
 * Google map directions service
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsService extends AbstractService
{
    /**
     * Creates a directions service
     */
    public function __construct()
    {
        parent::__construct('http://maps.googleapis.com/maps/api/directions');
    }
}
