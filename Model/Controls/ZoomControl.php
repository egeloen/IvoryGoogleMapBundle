<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * A zoom control describes a google map zoom control
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#ZoomControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControl
{
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::TOP_LEFT;

    /**
     * @var string Zoom control style
     */
    protected $zoomControlStyle = ZoomControlStyle::DEFAULT_;

    /**
     * Create a zoom control
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
            throw new \InvalidArgumentException(sprintf('The control position of a zoom control can only be : %s.', implode(', ', ControlPosition::getControlPositions())));
    }

    /**
     * Gets the zoom control style
     *
     * @return string
     */
    public function getZoomControlStyle()
    {
        return $this->zoomControlStyle;
    }

    /**
     * Sets the zoom control style
     *
     * @param string $zoomControlStyle
     */
    public function setZoomControlStyle($zoomControlStyle)
    {
        if(in_array($zoomControlStyle, ZoomControlStyle::getZoomControlStyles()))
            $this->zoomControlStyle = $zoomControlStyle;
        else
            throw new \InvalidArgumentException(sprintf('The zoom control style of a zoom control can only be : %s.', implode(', ', ZoomControlStyle::getZoomControlStyles())));
    }
}
