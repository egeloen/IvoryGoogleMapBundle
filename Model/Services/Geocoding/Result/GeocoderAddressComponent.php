<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding\Result;

/**
 * GeocoderAddressComponent which describes a google map geocoder address component
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderAddressComponent
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderAddressComponent 
{
    /**
     * @var string Address component long name
     */
    protected $longName = null;
    
    /**
     * @var string Address component short name
     */
    protected $shortName = null;
    
    /**
     * @var array Address component types
     */
    protected $types = array();
    
    /**
     * Creates a geocoder address component
     *
     * @param string $longName
     * @param string $shortName
     * @param array $types 
     */
    public function __construct($longName, $shortName, array $types)
    {
        $this->setLongName($longName);
        $this->setShortName($shortName);
        $this->setTypes($types);
    }
    
    /**
     * Gets the address component long name
     *
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }
    
    /**
     * Sets the address component long name
     *
     * @param string $longName 
     */
    public function setLongName($longName)
    {
        if(is_string($longName))
            $this->longName = $longName;
        else
            throw new \InvalidArgumentException('The geocoder address component long name must be a string value.');
    }
    
    /**
     * Gets the address component short name
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }
    
    /**
     * Sets the address component short name
     *
     * @param string $shortName 
     */
    public function setShortName($shortName)
    {
        if(is_string($shortName))
            $this->shortName = $shortName;
        else
            throw new \InvalidArgumentException('The geocoder address component short name must be a string value.');
    }
    
    /**
     * Gets the address component types
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }
    
    /**
     * Sets the address component types
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
     * Add an address component type
     *
     * @param string $type 
     */
    public function addType($type)
    {
        if(is_string($type))
            $this->types[] = $type;
        else
            throw new \InvalidArgumentException('The geocoder address component type must be a string value.');
    }
}
