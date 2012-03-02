<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control options describes a google map scale control options
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ScaleControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControl
{
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::BOTTOM_LEFT;

    /**
     * @var string Scale control style
     */
    protected $scaleControlStyle = ScaleControlStyle::DEFAULT_;

    /**
     * Create a scale control
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
            throw new \InvalidArgumentException(sprintf('The control position of a map type control can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }

    /**
     * Gets the scale control style
     *
     * @return string
     */
    public function getScaleControlStyle()
    {
        return $this->scaleControlStyle;
    }

    /**
     * Sets the scale control style
     *
     * @param type $scaleControlStyle
     */
    public function setScaleControlStyle($scaleControlStyle)
    {
        if(in_array($scaleControlStyle, ScaleControlStyle::getScaleControlStyles()))
            $this->scaleControlStyle = $scaleControlStyle;
        else
            throw new \InvalidArgumentException(sprintf('The scale control style of a scale control can only be : %s.', implode(', ', ScaleControlStyle::getScaleControlStyles())));
    }
}
