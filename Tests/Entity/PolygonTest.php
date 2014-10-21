<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Polygon;

/**
 * Polygon entity test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Polygon', new Polygon());
    }
}
