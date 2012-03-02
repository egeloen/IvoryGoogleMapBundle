<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsWaypoint which describes the google map directions waypoint
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypoint
{
    /**
     * @var string|Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    protected $location = null;

    /**
     * @var boolean TRUE indicates that this waypoint is a stop between the origin and destination else FALSE
     */
    protected $stopover = null;

    /**
     * Checks if the directions waypoint has a location
     *
     * @return boolean TRUE if the directions waypoint has a location else FALSE
     */
    public function hasLocation()
    {
        return !is_null($this->location);
    }

    /**
     * Gets the directions waypoint location
     *
     * @return string|Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the directions waypoint location
     *
     * Available prototypes:
     * - public function setLocation(string $destination)
     * - public function setLocation(double $latitude, double $longitude, boolean $noWrap)
     $ - public function setLocation(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)
     */
    public function setLocation()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_string($args[0]))
            $this->location = $args[0];
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(is_null($this->location))
                $this->location = new Coordinate();

            $this->location->setLatitude($args[0]);
            $this->location->setLongitude($args[1]);

            if(isset($args[2]) && is_bool($args[2]))
                $this->location->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->location = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The location setter arguments are invalid.',
                'The available prototypes are :',
                ' - public function setLocation(string $destination)',
                ' - public function setLocation(double $latitude, double $longitude, boolean $noWrap)',
                ' - public function setLocation(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)'));
    }

    /**
     * Checks if the directions waypoint has a stopover flag
     *
     * @return boolean TRUE if the directions waypoint has a stopover flag else FALSE
     */
    public function hasStopover()
    {
       return !is_null($this->stopover);
    }

    /**
     * Gets the directions waypoint stopover flag
     *
     * @return boolean
     */
    public function getStopover()
    {
        return $this->stopover;
    }

    /**
     * Sets the directions waypoint stopover flag
     *
     * @param boolean $stopover
     */
    public function setStopover($stopover = null)
    {
        if(is_bool($stopover) || is_null($stopover))
            $this->stopover = $stopover;
        else
            throw new \InvalidArgumentException('The directions waypoint stopover flag must be a boolean value.');
    }

    /**
     * Checks if the directions waypoint is valid
     *
     * @return boolean TRUE if the directions waypoint is valid else FALSE
     */
    public function isValid()
    {
        return $this->hasLocation();
    }
}
