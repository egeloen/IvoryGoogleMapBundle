<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Bound wich describes a google map bound
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate South west bound
     */
    protected $southWest = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate North east bound
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
     * Reset the bound to the initial state
     */
    public function reset()
    {   
        $this->southWest = null;
        $this->northEast = null;
        
        $this->extends = array();
    }
    
    /**
     * Checks if the bound is empty
     *
     * @return boolen TRUE if the bound is empty else FALSE
     */
    public function isEmpty()
    {
        return is_null($this->southWest) && is_null($this->northEast) && empty($this->extends);
    }

    /**
     * Gets the south west bound
     *
     * @return Ivory\GoogleMapBundle\Model\Coordinate
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west bound
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $southWest
     */
    public function setSouthWest(Coordinate $southWest = null)
    {
        $this->southWest = $southWest;
    }

    /**
     * Gets the north east bound
     *
     * @return Ivory\GoogleMapBundle\Model\Coordinate
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east bound
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $northEast
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
        foreach($extends as $extend)
            $this->extend($extend);
    }
    
    /**
     * Add a google map object for bound extend it
     *
     * @param Ivory\GoogleMapBundle\Model\AbstractAsset $extend 
     */
    public function extend(AbstractAsset $extend)
    {
        $this->extends[] = $extend;
    }
}
