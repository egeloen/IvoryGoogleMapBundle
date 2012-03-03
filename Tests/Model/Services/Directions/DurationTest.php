<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\Duration;

/**
 * Duration test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\Duration
     */
    protected static $duration = null;

    /**
     * @override
     */
    public function setUp()
    {
        self::$duration = new Duration('duration', 2.2);
    }

    /**
     * Checks the text getter & setter
     */
    public function testText()
    {
        $this->assertEquals(self::$duration->getText(), 'duration');

        $this->setExpectedException('InvalidArgumentException');
        self::$duration->setText(true);
    }

    /**
     * Checks the value getter & setter
     */
    public function testValue()
    {
        $this->assertEquals(self::$duration->getValue(), 2.2);

        $this->setExpectedException('InvalidArgumentException');
        self::$duration->setValue('foo');
    }
}
