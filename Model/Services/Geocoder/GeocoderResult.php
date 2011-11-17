<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoder;

/**
 * Geocoder result which describes a google map geocoder result
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderResult
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResult 
{
    /**
     * @var array Geocoder result address components
     */
    protected $addressComponents = array();
    
    /**
     * @var string Geocoder result formatted address
     */
    protected $formattedAddress = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\GeocoderGeometry Geocoder result geometry
     */
    protected $geometry = null;
    
    /**
     * @var boolean TRUE if the geocoder result is a partial match else FALSE
     */
    protected $partialMatch = null;
    
    /**
     * @var array Geocoder result types
     */
    protected $types = array();
    
    /**
     * Create a gecoder result
     *
     * @param array $addressComponents Geocoder result address components
     * @param string $formattedAddress Geocoder result formatted address
     * @param Ivory\GoogleMapBundle\Model\Services\GeocoderGeometry $geometry Geocoder result geometry
     * @param boolean Geocoder result partial match flag
     * @param array $types Geocoder result types
     */
    public function __construct(array $addressComponents, $formattedAddress, GeocoderGeometry $geometry, $partialMatch, array $types)
    {
        $this->setAddressComponents($addressComponents);
        $this->setFormattedAddress($formattedAddress);
        $this->setGeometry($geometry);
        $this->setPartialMatch($partialMatch);
        $this->setTypes($types);
    }
    
    /**
     * Gets address components
     *
     * @return array
     */
    public function getAddressComponents()
    {
        return $this->addressComponents;
    }
    
    /**
     * Sets address components
     *
     * @param array $addressComponents 
     */
    public function setAddressComponents(array $addressComponents)
    {
        $this->addressComponents = array();
        
        foreach($addressComponents as $addressComponent)
            $this->addAddressComponent($addressComponent);
    }
    
    /**
     * Add an address component to the geocoder result
     *
     * @param Ivory\GoogleMapBundle\Model\Services\GeocoderAddressComponent $addressComponent 
     */
    public function addAddressComponent(GeocoderAddressComponent $addressComponent)
    {
        $this->addressComponents[] = $addressComponent;
    }
    
    /**
     * Gets the formatted address
     *
     * @return string
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }
    
    /**
     * Sets the formatted address
     *
     * @param string $formattedAddress 
     */
    public function setFormattedAddress($formattedAddress)
    {
        if(is_string($formattedAddress))
            $this->formattedAddress = $formattedAddress;
        else
            throw new \InvalidArgumentException('The geocoder result formatted address must be a string value.');
    }
    
    /**
     * Gets the geocoder result geometry
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Geometry
     */
    public function getGeometry()
    {
        return $this->geometry;
    }
    
    /**
     * Sets the geocoder result geometry
     *
     * @param Ivory\GoogleMapBundle\Model\Services\GeocoderGeometry $geometry 
     */
    public function setGeometry(GeocoderGeometry $geometry)
    {
        $this->geometry = $geometry;
    }
    
    /**
     * Checks if the geocoder result is a partial match
     *
     * @return boolean TRUE if the geocoder result is a partial match else FALSE
     */
    public function isPartialMatch()
    {
        return $this->partialMatch;
    }
    
    /**
     * Sets the geocoder result partial match flag
     *
     * @param boolean $partialMatch TRUE if the geocoder result is a partial match else FALSE
     */
    public function setPartialMatch($partialMatch)
    {
        if(is_bool($partialMatch))
            $this->partialMatch = $partialMatch;
        else
            throw new \InvalidArgumentException('The geocoder result partial match flag must be a boolean value.');
    }
    
    /**
     * Gets the geocoder result types
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }
    
    /**
     * Sets the geocoder result types
     *
     * @param array $types 
     */
    public function setTypes(array $types)
    {
        $this->types = array();
        
        foreach($types as $type)
            $this->addType($type);
    }
    
    /**
     * Add a type to the geocoder result
     *
     * @param string $type 
     */
    public function addType($type)
    {
        if(is_string($type))
            $this->types[] = $type;
        else
            throw new \InvalidArgumentException('The geocoder result type must be a string value.');
    }
}
