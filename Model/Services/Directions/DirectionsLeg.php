<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsLeg which describes a google map directions leg
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsLeg
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsLeg
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Distance Leg distance
     */
    protected $distance = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Duration Leg duration
     */
    protected $duration = null;

    /**
     * @var string Leg end address
     */
    protected $endAddress = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Leg end location
     */
    protected $endLocation = null;

    /**
     * @var string Leg start address
     */
    protected $startAddress = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Leg start location
     */
    protected $startLocation = null;

    /**
     * @var array Leg steps
     */
    protected $steps = array();

    /**
     * @todo Find what is this property
     */
    protected $viaWaypoints = array();

    /**
     * Creates a directions leg
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Distance $distance
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Duration $duration
     * @param string $endAddress
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $endLocation
     * @param string $startAddress
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $startLocation
     * @param array $steps
     */
    public function __construct(Distance $distance, Duration $duration, $endAddress, Coordinate $endLocation, $startAddress, Coordinate $startLocation, array $steps)
    {
        $this->setDistance($distance);
        $this->setDuration($duration);
        $this->setEndAddress($endAddress);
        $this->setEndLocation($endLocation);
        $this->setStartAddress($startAddress);
        $this->setStartLocation($startLocation);
        $this->setSteps($steps);
    }

    /**
     * Gets the leg distance
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\Distance
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Sets the leg distance
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Distance $distance
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }

    /**
     * Gets the leg duration
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Sets the leg duration
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Duration $duration
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }

    /**
     * Gets the leg end address
     *
     * @return string
     */
    public function getEndAddress()
    {
        return $this->endAddress;
    }

    /**
     * Sets the leg end address
     *
     * @param string Leg end address
     */
    public function setEndAddress($endAddress)
    {
        if(is_string($endAddress))
            $this->endAddress = $endAddress;
        else
            throw new \InvalidArgumentException('The leg end address must be a string value.');
    }

    /**
     * Gets the leg end location
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }

    /**
     * Sets the leg end location
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $endLocation
     */
    public function setEndLocation(Coordinate $endLocation)
    {
        $this->endLocation = $endLocation;
    }

    /**
     * Gets the leg start address
     *
     * @return string
     */
    public function getStartAddress()
    {
        return $this->startAddress;
    }

    /**
     * Sets the leg start address
     *
     * @param string $startAddress
     */
    public function setStartAddress($startAddress)
    {
        if(is_string($startAddress))
            $this->startAddress = $startAddress;
        else
            throw new \InvalidArgumentException('The leg start address must be a string value.');
    }

    /**
     * Gets the leg start location
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }

    /**
     * Sets the leg start location
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $startLocation
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }

    /**
     * Gets the leg steps
     *
     * @return array
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Sets the leg steps
     *
     * @param array $steps
     */
    public function setSteps(array $steps)
    {
        $this->steps = array();

        foreach($steps as $step)
            $this->addStep($step);
    }

    /**
     * Add a step to the leg
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStep
     */
    public function addStep(DirectionsStep $step)
    {
        $this->steps[] = $step;
    }
}
