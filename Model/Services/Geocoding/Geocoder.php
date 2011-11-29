<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

use Geocoder\Geocoder as BaseGeocoder;

/**
 * Geocoder which describes a google map geocoder
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Geocoder
 * @author GeLo <geloen.eric@gmail.com>
 */
class Geocoder extends BaseGeocoder
{
    /**
     * {@inheritDoc}
     */
    public function geocode($request)
    {
        if($this->getProvider() instanceof Provider)
            return $this->getProvider()->getGeocodedData($request);
        else
            return parent::geocode($request);
    }
    
    /**
     * {@inheritDoc}
     */
    public function reverse($latitude, $longitude)
    {
        if($this->getProvider() instanceof Provider)
        {
            $value = $latitude.'-'.$longitude;
            return $this->getProvider()->getReversedData(array($latitude, $longitude));
        }
        else
            return parent::reverse($latitude, $longitude);
    }
}
