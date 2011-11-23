<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding\Result;

use Geocoder\Result\Geocoded;

/**
 * Geocoder response wraps the geocoder results & the response status
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponse extends Geocoded
{
    /**
     * @var array Geocoder results
     */
    protected $results = array();
    
    /**
     * @var string Geocoder results status
     */
    protected $status = null;
    
    /**
     * Create a geocoder results
     *
     * @param array $results
     * @param string $status 
     */
    public function __construct(array $results, $status)
    {
        $this->setResults($results);
        $this->setStatus($status);
    }
    
    /**
     * Gets the geocoder results
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
    
    /**
     * Sets the geocoder results
     *
     * @param array $results 
     */
    public function setResults(array $results)
    {
        $this->results = array();
        
        foreach($results as $result)
            $this->addResult($result);
    }
    
    /**
     * Add a geocoder result
     *
     * @todo Parse result to update geocoded properties
     * @param Ivory\GoogleMapBundle\Model\Services\Result\GeocoderResult $result 
     */
    public function addResult(GeocoderResult $result)
    {
        if(is_null($this->latitude))
        {
            $this->latitude = $result->getGeometry()->getLocation()->getLatitude();
            $this->longitude = $result->getGeometry()->getLocation()->getLongitude();
            
            foreach($result->getAddressComponents() as $addressComponent)
            {
                foreach($addressComponent->getTypes() as $type)
                {
                    switch($type) 
                    {
                        case 'postal_code':
                            $this->zipcode = $addressComponent->getLongName();
                        break;

                        case 'locality':
                            $this->city = $addressComponent->getLongName();
                        break;

                        case 'administrative_area_level_1':
                            $this->region = $addressComponent->getLongName();
                        break;

                        case 'country':
                            $this->country = $addressComponent->getLongName();
                        break;

                        default:
                        break;
                    }
                }
            }
        }
        
        $this->results[] = $result;
    }
    
    /**
     * Gets the geocoder results status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Sets the geocoder results status
     *
     * @param string $status 
     */
    public function setStatus($status)
    {
        if(in_array($status, GeocoderStatus::getGeocoderStatus()))
            $this->status = $status;
        else
            throw new \InvalidArgumentException('The geocoder response status can only be : '.implode(', ', GeocoderStatus::getGeocoderStatus()));
    }
}
