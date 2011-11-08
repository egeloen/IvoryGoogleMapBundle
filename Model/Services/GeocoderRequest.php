<?php

namespace Ivory\GoogleMapBundle\Model\Services;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Geocoder request which describes a google map geocoder request
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequest 
{
    /**
     * @var string Requested address
     */
    protected $address = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Requested coordinate
     */
    protected $coordinate = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound Requested bound
     */
    protected $bound = null;
    
    /**
     * @var string Requested region
     */
    protected $region = null;
    
    /**
     * @var string Requested language
     */
    protected $language = null;
    
    /**
     * @var boolean TRUE if the request has a sensor else FALSE
     */
    protected $sensor = false;
    
    /**
     * Checks if the geocoder request has an address
     *
     * @return boolean TRUE if the geocoder request has an address else FALSE
     */
    public function hasAddress()
    {
        return !is_null($this->address);
    }
    
    /**
     * Gets the geocoder request address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Sets the geocoder request address
     *
     * @param string $address 
     * @return Ivory\GoogleMapBundle\Model\Services\GeocoderRequest $this
     */
    public function setAddress($address)
    {
        if(is_string($address) || is_null($address))
            $this->address = $address;
        else
            throw new \InvalidArgumentException('The geocoder request address must be a string value.');
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request has a coordinate
     *
     * @return boolean TRUE if the geocoder request has a coordinate else FALSE
     */
    public function hasCoordinate()
    {
        return !is_null($this->coordinate);
    }
    
    /**
     * Gets the geocoder request coordinate
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }
    
    /**
     * Sets the geocoder request coordinate
     * 
     * Available prototype:
     * 
     * public function setCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate = null)
     * public function setCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     * 
     * @return Ivory\GoogleMapBundle\Model\Services\GeocoderRequest $this
     */
    public function setCoordinate()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(!$this->hasCoordinate())
                $this->coordinate = new Coordinate();
            
            $this->coordinate->setLatitude($args[0]);
            $this->coordinate->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->coordinate->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->coordinate = $args[0];
        else if(!isset($args[0]))
            $this->coordinate = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The coordinate setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate = null)',
                ' - public function setCoordinate(double $latitude, double $longitude, boolean $noWrap = true)'));
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request has a bound
     *
     * @return boolean TRUE if the geocoder request has a bound else FALSE
     */
    public function hasBound()
    {
        return !is_null($this->bound);
    }
    
    /**
     * Gets the geocoder request bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }
    
    /**
     * Sets the geocoder request bound
     *
     * Available prototype:
     * 
     * public function setBound(Ivory\GoogleMapBundle\Model\Base\Bound $bound = null)
     * public function setBount(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast)
     * public function setBound(double $southWestLatitude, double $southWestLongitude, double $northEastLatitude, double $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)
     * 
     * @return Ivory\GoogleMapBundle\Model\Services\GeocoderRequest $this
     */
    public function setBound()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && ($args[0] instanceof Bound))
            $this->bound = $args[0];
        else if(isset($args[0]) && ($args[0] instanceof Coordinate) && isset($args[1]) && ($args[1] instanceof Coordinate))
        {
            if(is_null($this->bound))
                $this->bound = new Bound();
            
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        }
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]) && isset($args[2]) && is_numeric($args[2]) && isset($args[3]) && is_numeric($args[3]))
        {
            if(is_null($this->bound))
                $this->bound = new Bound();
            
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));
            
            if(isset($args[4]) && is_bool($args[4]))
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            
            if(isset($args[5]) && is_bool($args[5]))
                $this->bound->getNorthEast()->setNoWrap($args[5]);
        }
        else if(!isset($args[0]))
            $this->bound = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The bound setter arguments are invalid.',
                'The available prototypes are :',
                ' - public function setBound(Ivory\GoogleMapBundle\Model\Base\Bound $bound = null)',
                ' - public function setBound(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast)',
                ' - public function setBound(double $southWestLatitude, double $southWestLongitude, double $northEastLatitude, double $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)'));
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request has a region
     *
     * @return boolean TRUE if the geocoder request has a region else FALSE
     */
    public function hasRegion()
    {
        return !is_null($this->region);
    }
    
    /**
     * Gets the geocoder request region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }
    
    /**
     * Sets the geocoder request region
     *
     * @param string $region 
     * @return Ivory\GoogleMapBundle\Model\Services\GeocoderRequest $this
     */
    public function setRegion($region = null)
    {
        if((is_string($region) && (strlen($region) == 2)) || is_null($region))
            $this->region = $region;
        else
            throw new \InvalidArgumentException('The geocoder request region must be a string with two characters.');
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request has a language
     *
     * @return boolean TRUE if the geocoder request has a language else FALSE
     */
    public function hasLanguage()
    {
        return !is_null($this->language);
    }
    
    /**
     * Gets the geocoder request language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the geocoder request language
     *
     * @param string $language 
     * @return Ivory\GoogleMapBundle\Model\Services\GeocoderRequest $this
     */
    public function setLanguage($language = null)
    {
        if(is_string($language) || is_null($language))
            $this->language = $language;
        else
            throw new \InvalidArgumentException('The geocoder request language must be a string value.');
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request has a sensor
     *
     * @return boolean TRUE if the geocoder request has a sensor else FALSE
     */
    public function hasSensor()
    {
        return $this->sensor;
    }
    
    /**
     * Sets the geocoder request sensor
     *
     * @param boolean $sensor TRUE if the geocoder request has a sensor else FALSE
     */
    public function setSensor($sensor)
    {
        if(is_bool($sensor))
            $this->sensor = $sensor;
        else
            throw new \InvalidArgumentException('The geocoder request sensor flag must be a boolean value.');
        
        return $this;
    }
    
    /**
     * Checks if the geocoder request is valid
     * 
     * @return boolean TRUE if the geocoder request is valid else FALSE
     */
    public function isValid()
    {
        return $this->hasAddress() || $this->hasCoordinate();
    }
}
