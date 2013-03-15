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
 * Rotate control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlBuilder extends AbstractBuilder
{
    /** @var string */
    protected $controlPosition;

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
     * @return \Ivory\GoogleMapBundle\Model\Controls\RotateControlBuilder The builder.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->controlPosition = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Controls\RotateControl The rotate control.
     */
    public function build()
    {
        $rotateControl = new $this->class();

        if ($this->controlPosition !== null) {
            $rotateControl->setControlPosition($this->controlPosition);
        }

        return $rotateControl;
    }
}
