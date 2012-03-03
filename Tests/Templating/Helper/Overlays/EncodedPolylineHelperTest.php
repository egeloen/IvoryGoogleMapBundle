<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\EncodedPolylineHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper;

use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

/**
 * EncodedPolylineHelper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\EncodedPolylineHelper $encodedPolylineHelper Encoded polyline helper tested
     */
    protected static $encodedPolylineHelper = null;

    /**
     * @override
     */
    public function setUp()
    {
        self::$encodedPolylineHelper = new EncodedPolylineHelper(new EncodingHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        $encodedPolylineTest = new EncodedPolyline('value');

        $this->assertEquals(self::$encodedPolylineHelper->render($encodedPolylineTest, $mapTest), 'var '.$encodedPolylineTest->getJavascriptVariable().' = new google.maps.Polyline({"map":'.$mapTest->getJavascriptVariable().',"path":google.maps.geometry.encoding.decodePath("value")});'.PHP_EOL);

        $encodedPolylineTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertEquals(self::$encodedPolylineHelper->render($encodedPolylineTest, $mapTest), 'var '.$encodedPolylineTest->getJavascriptVariable().' = new google.maps.Polyline({"map":'.$mapTest->getJavascriptVariable().',"path":google.maps.geometry.encoding.decodePath("value"),"option1":"value1","option2":"value2"});'.PHP_EOL);
    }
}
