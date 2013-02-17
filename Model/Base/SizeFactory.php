<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMap\Base\Size;

/**
 * Size factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeFactory
{
    /**
     * Creates a size.
     *
     * @param double $width      The width.
     * @param double $height     The height.
     * @param string $widthUnit  The width unit.
     * @param string $heightUnit The height unit.
     *
     * @return \Ivory\GoogleMap\Base\Size The size.
     */
    public function create($width = 1, $height = 1, $widthUnit = null, $heightUnit = null)
    {
        return new Size($width, $height, $widthUnit, $heightUnit);
    }
}
