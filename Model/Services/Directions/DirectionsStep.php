<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsStep which describes a google map directions step
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsStep
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsStep 
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Distance Step distance
     */
    protected $distance = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Duration Step duration
     */
    protected $duration = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Step end location
     */
    protected $endLocation = null;
    
    /**
     * @var string Step instructions
     */
    protected $instructions = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline
     */
    protected $encodedPolyline = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Step start location
     */
    protected $startLocation = null;
    
    /**
     * @var string Travel mode used by the step
     */
    protected $travelMode = null;
    
    /**
     * Creates a directions step
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Distance $distance
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Duration $duration 
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $endLocation
     * @param string $instructions
     * @param Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline $encodedPolyline
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $startLocation
     * @param string $travelMode
     */
    public function __construct(Distance $distance, Duration $duration, Coordinate $endLocation, $instructions, EncodedPolyline $encodedPolyline, Coordinate $startLocation, $travelMode)
    {
        $this->setDistance($distance);
        $this->setDuration($duration);
        $this->setEndLocation($endLocation);
        $this->setInstructions($instructions);
        $this->setEncodedPolyline($encodedPolyline);
        $this->setStartLocation($startLocation);
        $this->setTravelMode($travelMode);
    }
    
    /**
     * Gets the step distance
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\Distance
     */
    public function getDistance()
    {
        return $this->distance;
    }
    
    /**
     * Sets the step distance
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Distance $distance 
     */
    public function setDistance(Distance $distance)
    {
        $this->distance = $distance;
    }
    
    /**
     * Gets the step duration
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }
    
    /**
     * Sets the step duration
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\Duration $duration 
     */
    public function setDuration(Duration $duration)
    {
        $this->duration = $duration;
    }
    
    /**
     * Gets the step end location
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }
    
    /**
     * Sets the step end location
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $endLocation 
     */
    public function setEndLocation(Coordinate $endLocation)
    {
        $this->endLocation = $endLocation;
    }
    
    /**
     * Gets the step instructions
     *
     * @return string
     */
    public function getInstructions()
    {
        return $this->instructions;
    }
    
    /**
     * Sets the step instructions
     *
     * @param string $instructions 
     */
    public function setInstructions($instructions)
    {
        if(is_string($instructions))
            $this->instructions = $instructions;
        else
            throw new \InvalidArgumentException('The step instructions must be a string value.');
    }
    
    /**
     * Gets the encoded polyline which describes the step
     *
     * @return Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline
     */
    public function getEncodedPolyline()
    {
        return $this->encodedPolyline;
    }
    
    /**
     * Sets the encoded polyline which describes the step
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline $encodedPolyline 
     */
    public function setEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        $this->encodedPolyline = $encodedPolyline;
    }
    
    /**
     * Gets the step start location
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }
    
    /**
     * Sets the step start location
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Coordinate $startLocation 
     */
    public function setStartLocation(Coordinate $startLocation)
    {
        $this->startLocation = $startLocation;
    }
    
    /**
     * Gets the step travel mode
     *
     * @return string
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }
    
    /**
     * Sets the step travel mode
     *
     * @param string $travelMode 
     */
    public function setTravelMode($travelMode)
    {
        if(in_array($travelMode, TravelMode::getTravelModes()))
            $this->travelMode = $travelMode;
        else
            throw new \InvalidArgumentException(sprintf('The directions step travel mode can only be : %s.', implode(', ', TravelMode::getTravelModes())));
    }
}
