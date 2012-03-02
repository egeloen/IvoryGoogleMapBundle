<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * A pan control describes a google map pan control
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PanControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControl
{
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::TOP_LEFT;

    /**
     * Create a pan control
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
            throw new \InvalidArgumentException(sprintf('The control position of a pan control can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }
}
