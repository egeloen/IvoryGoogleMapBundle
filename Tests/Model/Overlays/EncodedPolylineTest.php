<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

/**
 * EncodedPolyline test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline
     */
    protected static $encodedPolyline = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$encodedPolyline = new EncodedPolyline('value');
    }

    /**
     * Checks the value getter & setter
     */
    public function testValue()
    {
        $this->assertEquals(self::$encodedPolyline->getValue(), 'value');

        $this->setExpectedException('InvalidArgumentException');
        self::$encodedPolyline->setValue(true);
    }
}
