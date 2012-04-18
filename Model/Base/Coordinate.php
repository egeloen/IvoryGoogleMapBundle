<?php

namespace Ivory\GoogleMapBundle\Model\Base;

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
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setNoWrap($noWrap);
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
        if(is_numeric($latitude) || is_null($latitude))
            $this->latitude = $latitude;
        else
            throw new \InvalidArgumentException('The latitude of a coordinate must be a numeric value.');
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
        if(is_numeric($longitude) || is_null($longitude))
            $this->longitude = $longitude;
        else
            throw new \InvalidArgumentException('The longitude of a coordinate must be a numeric value.');
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
        if(is_bool($noWrap) || is_null($noWrap))
            $this->noWrap = $noWrap;
        else
            throw new \InvalidArgumentException('The no wrap coordinate property must be a boolean value.');
    }
}
