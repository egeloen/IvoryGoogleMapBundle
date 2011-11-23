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
        {
            $result = $this->retrieve($request);

            if(is_null($result))
            {
                $result = $this->getProvider()->getGeocodedData($request);
                $this->store($request, $result);
            }

            return $result;
        }
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
            $value = sprintf('%s-%s', $latitude, $longitude);
            $result = $this->retrieve($value);

            if(is_null($result))
            {
                $result = $this->getProvider()->getGeocodedData($geocoderRequest);
                $this->store($value, $result);
            }

            return $result;
        }
        else
            return parent::geocode($request);
    }
}
