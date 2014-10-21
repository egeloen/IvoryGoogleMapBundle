<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMap\Map as BaseMap;

/**
 * {@inheritdoc}
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends BaseMap
{
    /**
     * Cleans up the map before database persist.
     */
    public function prePersist()
    {
        if ($this->isAutoZoom()) {
            $this->center = null;
        } else {
            $this->bound = null;
        }
    }
}
