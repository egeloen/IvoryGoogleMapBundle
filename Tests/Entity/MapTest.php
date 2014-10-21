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

use Ivory\GoogleMapBundle\Entity\Map;

/**
 * Map entity test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Map */
    protected $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->map = new Map();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->map);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Map', $this->map);
    }

    public function testPrePersistWithoutAutozoom()
    {
        $this->map->setCenter(-1.1, -2.2);
        $this->map->setBound(1, 2, 3, 4);

        $this->map->prePersist();

        $this->assertSame(-1.1, $this->map->getCenter()->getLatitude());
        $this->assertSame(-2.2, $this->map->getCenter()->getLongitude());

        $this->assertNull($this->map->getBound());
    }

    public function testPrePersistWithAutozoom()
    {
        $this->map->setCenter(-1.1, -2.2);
        $this->map->setBound(1, 2, 3, 4);

        $this->map->setAutoZoom(true);
        $this->map->prePersist();

        $this->assertNull($this->map->getCenter());

        $this->assertSame(1, $this->map->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $this->map->getBound()->getSouthWest()->getLongitude());
        $this->assertSame(3, $this->map->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $this->map->getBound()->getNorthEast()->getLongitude());
    }
}
