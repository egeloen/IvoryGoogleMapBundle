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

use Ivory\GoogleMapBundle\Entity\OverviewMapControl;

/**
 * Overview map control entity test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Controls\OverviewMapControl', new OverviewMapControl());
    }
}
