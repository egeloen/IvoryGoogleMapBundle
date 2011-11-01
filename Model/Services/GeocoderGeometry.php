<?php

namespace Ivory\GoogleMapBundle\Model\Services;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * GeocoderGeometry which describes a google map geocoder geometry
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderGeometry
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderGeometry 
{   
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    protected $location = null;
    
    /**
     * @var string
     */
    protected $locationType = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound
     */
    protected $viewport = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound
     */
    protected $bound = null;
    
    /**
     * Create a geocoder geometry
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $location
     * @param string $locationType
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $viewport 
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound
     */
    public function __construct(Coordinate $location, $locationType, Bound $viewport, Bound $bound = null)
    {
        $this->location = $location;
        $this->locationType = $locationType;
        $this->viewport = $viewport;
        $this->bound = $bound;
    }
    
    /**
     * Gets the location
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * Sets the location
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $location 
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }
    
    /**
     * Gets the location type
     *
     * @return string
     */
    public function getLocationType()
    {
        return $this->locationType;
    }
    
    /**
     * Sets the location type
     *
     * @param string $locationType 
     */
    public function setLocationType($locationType)
    {
        if(in_array($locationType, GeocoderLocationType::getGeocoderLocationTypes()))
            $this->locationType = $locationType;
        else
            throw new \InvalidArgumentException('The geocoder geometry location type can only be : '.implode(', ', GeocoderLocationType::getGeocoderLocationTypes()));
    }
    
    /**
     * Gets the viewport
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Bound
     */
    public function getViewport()
    {
        return $this->viewport;
    }
    
    /**
     * Sets the viewport
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $viewport 
     */
    public function setViewport(Bound $viewport)
    {
        $this->viewport = $viewport;
    }
    
    /**
     * Gets the bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }
    
    /**
     * Sets the bound
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound 
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
