<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Coordinate which describes a google map coordinate
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLng
 * @author GeLo <geloen.eric@gmail.com>
 */
class Coordinate
{
    /**
     * @var double $latitude
     */
    protected $latitude = 0;

    /**
     * @var double $longitude
     */
    protected $longitude = 0;

    /**
     * @var boolean $noWrap TRUE if the coordinate is not wrap else FALSE
     */
    protected $noWrap = true;

    /**
     * Create a coordinate
     *
     * @param double $latitude
     * @param double $longitude
     * @param boolean $noWrap 
     */
    public function __construct($latitude = 0, $longitude = 0, $noWrap = true)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->noWrap = $noWrap;
    }

    /**
     * Gets the latitude
     *
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param double $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Gets the longitude
     *
     * @return doube
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    /**
     * Sets the longitude
     *
     * @param double $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Check if the coordinate is not wrap
     *
     * @return boolean TRUE if the coordinate is not wrap else FALSE
     */
    public function isNoWrap()
    {
        return $this->noWrap;
    }

    /**
     * Sets if the coordinate is wrap
     *
     * @param boolean $noWrap TRUE if the coordinate is not wrap else FALSE
     */
    public function setNoWrap($noWrap)
    {
        $this->noWrap = $noWrap;
    }
}