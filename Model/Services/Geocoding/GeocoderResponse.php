<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

/**
 * Geocoder response wraps the geocoder results & the response status
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResponse
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
     * @param Ivory\GoogleMapBundle\Model\Services\GeocoderResult $result 
     */
    public function addResult(GeocoderResult $result)
    {
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
