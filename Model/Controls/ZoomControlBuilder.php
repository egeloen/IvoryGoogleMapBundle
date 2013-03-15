<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Controls;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Zoom control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlBuilder extends AbstractBuilder
{
    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $zoomControlStyle;

    /**
     * Gets the control position.
     *
     * @return string The control position.
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }

    /**
     * Sets the control position.
     *
     * @param string $controlPosition The control position.
     *
     * @return \Ivory\GoogleMapBundle\Model\Controls\ZoomControlBuilder The builder.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;

        return $this;
    }

    /**
     * Gets the zoom control style.
     *
     * @return string The zoom control style.
     */
    public function getZoomControlStyle()
    {
        return $this->zoomControlStyle;
    }

    /**
     * Sets the zoom control style.
     *
     * @param string $zoomControlStyle The zoom control style.
     *
     * @return \Ivory\GoogleMapBundle\Model\Controls\ZoomControlBuilder The builder.
     */
    public function setZoomControlStyle($zoomControlStyle)
    {
        $this->zoomControlStyle = $zoomControlStyle;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->controlPosition = null;
        $this->zoomControlStyle = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Controls\ZoomControl The zoom control.
     */
    public function build()
    {
        $zoomControl = new $this->class();

        if ($this->controlPosition !== null) {
            $zoomControl->setControlPosition($this->controlPosition);
        }

        if ($this->zoomControlStyle !== null) {
            $zoomControl->setZoomControlStyle($this->zoomControlStyle);
        }

        return $zoomControl;
    }
}
