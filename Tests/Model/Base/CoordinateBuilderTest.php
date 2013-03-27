<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;

/**
 * Coordinate builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->coordinateBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Base\Coordinate', $this->coordinateBuilder->getClass());
        $this->assertNull($this->coordinateBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->coordinateBuilder->getLatitude());
        $this->assertNull($this->coordinateBuilder->getLongitude());
        $this->assertNull($this->coordinateBuilder->isNoWrap());
    }

    public function testSingleBuildWithoutValues()
    {
        $coordinate = $this->coordinateBuilder->build();

        $this->assertSame('coordinate_', substr($coordinate->getJavascriptVariable(), 0, 11));
        $this->assertSame(0, $coordinate->getLatitude());
        $this->assertSame(0, $coordinate->getLongitude());
        $this->assertTrue($coordinate->isNoWrap());
    }

    public function testSingleBuildWithValues()
    {
        $this->coordinateBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setLatitude(1)
            ->setLongitude(2)
            ->setNoWrap(false);

        $this->assertSame('foo', $this->coordinateBuilder->getPrefixJavascriptVariable());
        $this->assertSame(1, $this->coordinateBuilder->getLatitude());
        $this->assertSame(2, $this->coordinateBuilder->getLongitude());
        $this->assertFalse($this->coordinateBuilder->isNoWrap());

        $coordinate = $this->coordinateBuilder->build();

        $this->assertSame('foo', substr($coordinate->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $coordinate->getLatitude());
        $this->assertSame(2, $coordinate->getLongitude());
        $this->assertFalse($coordinate->isNoWrap());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->coordinateBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setLatitude(1)
            ->setLongitude(2)
            ->setNoWrap(false);

        $coordinate1 = $this->coordinateBuilder->build();
        $coordinate2 = $this->coordinateBuilder->build();

        $this->assertNotSame($coordinate1, $coordinate2);

        $this->assertSame('foo', substr($coordinate1->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $coordinate1->getLatitude());
        $this->assertSame(2, $coordinate1->getLongitude());
        $this->assertFalse($coordinate1->isNoWrap());

        $this->assertSame('foo', substr($coordinate2->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $coordinate2->getLatitude());
        $this->assertSame(2, $coordinate2->getLongitude());
        $this->assertFalse($coordinate2->isNoWrap());
    }

    public function testMultipleBuildWithReset()
    {
        $this->coordinateBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setLatitude(1)
            ->setLongitude(2)
            ->setNoWrap(false);

        $coordinate1 = $this->coordinateBuilder->build();
        $this->coordinateBuilder->reset();
        $coordinate2 = $this->coordinateBuilder->build();

        $this->assertSame('foo', substr($coordinate1->getJavascriptVariable(), 0, 3));
        $this->assertSame(1, $coordinate1->getLatitude());
        $this->assertSame(2, $coordinate1->getLongitude());
        $this->assertFalse($coordinate1->isNoWrap());

        $this->assertSame('coordinate_', substr($coordinate2->getJavascriptVariable(), 0, 11));
        $this->assertSame(0, $coordinate2->getLatitude());
        $this->assertSame(0, $coordinate2->getLongitude());
        $this->assertTrue($coordinate2->isNoWrap());
    }
}
