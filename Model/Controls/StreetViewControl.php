<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * A street view control describes a google map street view control
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#StreetViewControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControl
{
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::TOP_LEFT;
    
    /**
     * Create a street view control
     */
    public function __construct()
    {
        
    }
    
    /**
     * Gets the control position
     *
     * @return string
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }
    
    /**
     * Sets the control position
     *
     * @param string $controlPosition 
     */
    public function setControlPosition($controlPosition)
    {
        if(in_array($controlPosition, ControlPosition::getControlPositions()))
            $this->controlPosition = $controlPosition;
        else
            throw new \InvalidArgumentException(sprintf('The control position of a street view control can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }
}
