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

use Ivory\GoogleMap\Controls\OverviewMapControl;

/**
 * Overview map control factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlFactory
{
    /**
     * Creates an overview map control.
     *
     * @param boolean $opened TRUE if the overview map control is opened else FALSE.
     *
     * @return \Ivory\GoogleMap\Controls\OverviewMapControl The overview map control.
     */
    public function create($opened = false)
    {
        return new OverviewMapControl($opened);
    }
}
