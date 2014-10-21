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
 * Overview map control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlBuilder extends AbstractBuilder
{
    /** @var boolean */
    protected $opened;

    /**
     * Gets the opened flag.
     *
     * @return boolean The opened flag.
     */
    public function isOpened()
    {
        return $this->opened;
    }

    /**
     * Sets the opened flag.
     *
     * @param boolean $opened The opened flag.
     *
     * @return \Ivory\GoogleMapBundle\Model\Controls\OverviewMapControlBuilder The builder.
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->opened = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Controls\OverviewMapControl The overview map control.
     */
    public function build()
    {
        $overviewMapControl = new $this->class();

        if ($this->opened !== null) {
            $overviewMapControl->setOpened($this->opened);
        }

        return $overviewMapControl;
    }
}
