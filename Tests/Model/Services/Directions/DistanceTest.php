<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\Distance;

/**
 * Distance test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Distance
     */
    protected static $distance = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$distance = new Distance('distance', 2.2);
    }

    /**
     * Checks the text getter & setter
     */
    public function testText()
    {
        $this->assertEquals(self::$distance->getText(), 'distance');

        $this->setExpectedException('InvalidArgumentException');
        self::$distance->setText(true);
    }

    /**
     * Checks the value getter & setter
     */
    public function testValue()
    {
        $this->assertEquals(self::$distance->getValue(), 2.2);

        $this->setExpectedException('InvalidArgumentException');
        self::$distance->setValue('foo');
    }
}
