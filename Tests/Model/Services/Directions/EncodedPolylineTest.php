<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline;

/**
 * EncodedPolyline test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline
     */
    protected static $encodedPolyline = null;
    
    /**
     * @override
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
