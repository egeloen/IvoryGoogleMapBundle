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
 * Pan control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlBuilder extends AbstractBuilder
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
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;
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
     * @return \Ivory\GoogleMap\Controls\PanControl The pan control.
     */
    public function build()
    {
        $panControl = new $this->class();

        if ($this->controlPosition !== null) {
            $panControl->setControlPosition($this->controlPosition);
        }

        return $panControl;
    }
}
