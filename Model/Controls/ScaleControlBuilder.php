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
 * Scale control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlBuilder extends AbstractBuilder
{
    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $scaleControlStyle;

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
     * @return \Ivory\GoogleMapBundle\Model\Controls\ScaleControlBuilder The builder.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;

        return $this;
    }

    /**
     * Gets the scale control style.
     *
     * @return string The scale control style.
     */
    public function getScaleControlStyle()
    {
        return $this->scaleControlStyle;
    }

    /**
     * Sets the scale control style.
     *
     * @param string $scaleControlStyle The scale control style.
     *
     * @return \Ivory\GoogleMapBundle\Model\Controls\ScaleControlBuilder The builder.
     */
    public function setScaleControlStyle($scaleControlStyle)
    {
        $this->scaleControlStyle = $scaleControlStyle;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->controlPosition = null;
        $this->scaleControlStyle = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Controls\ScaleControl The scale control.
     */
    public function build()
    {
        $scaleControl = new $this->class();

        if ($this->controlPosition !== null) {
            $scaleControl->setControlPosition($this->controlPosition);
        }

        if ($this->scaleControlStyle !== null) {
            $scaleControl->setScaleControlStyle($this->scaleControlStyle);
        }

        return $scaleControl;
    }
}
