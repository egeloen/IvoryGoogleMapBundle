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
    public function setSouthWest(Coordinate $southWest)
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
    public function setNorthEast(Coordinate $northEast)
    {
        $this->northEast = $northEast;
    }
}
