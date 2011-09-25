<?php

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMapBundle\Model\Overlays\IExtendable;

/**
 * Bound wich describes a google map bound
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate South west bound
     */
    protected $southWest = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate North east bound
     */
    protected $northEast = null;
    
    /**
     * @var array Google map objects that bound extends
     */
    protected $extends = array();

    /**
     * Create a bound
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('bound_');
    }
    
    /**
     * Checks if the bound has coordinates
     *
     * @return boolean TRUE if the bound has coordinates else FALSE
     */
    public function hasCoordinates()
    {
        return !is_null($this->southWest) && !is_null($this->northEast);
    }
    
    /**
     * Checks if the bound extends something
     *
     * @return boolean TRUE if the bound extends somethind else FALSE
     */
    public function hasExtends()
    {
        return !empty($this->extends);
    }
    
    /**
     * Reset the bound to the initial state
     */
    public function reset()
    {   
        $this->southWest = null;
        $this->northEast = null;
        
        $this->extends = array();
    }

    /**
     * Gets the south west bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west bound
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest
     */
    public function setSouthWest(Coordinate $southWest = null)
    {
        $this->southWest = $southWest;
    }

    /**
     * Gets the north east bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east bound
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast
     */
    public function setNorthEast(Coordinate $northEast = null)
    {
        $this->northEast = $northEast;
    }
    
    /**
     * Gets the google map objects that bound extends
     *
     * @return array
     */
    public function getExtends()
    {
        return $this->extends;
    }
    
    /**
     * Sets the google map objects that bound extends
     *
     * @param array $extends 
     */
    public function setExtends($extends)
    {
        $this->reset();
        
        foreach($extends as $extend)
            $this->extend($extend);
    }
    
    /**
     * Add an overlay google map extendable object for bound extend it
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\IExtendable $extend 
     */
    public function extend(IExtendable $extend)
    {
        $this->extends[] = $extend;
    }
}
