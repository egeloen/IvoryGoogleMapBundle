<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * A rotate control describes a google map rotate control
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#RotateControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControl
{
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::TOP_LEFT;

    /**
     * Create a rotate control
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
            throw new \InvalidArgumentException(sprintf('The control position of a rotate control can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }
}
