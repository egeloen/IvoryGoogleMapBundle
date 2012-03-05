<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerShapeHelper;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerShape;

/**
 * Marker shape helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerShapeHelper
     */
    protected static $markerShapeHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$markerShapeHelper = new MarkerShapeHelper(new PointHelper(), new SizeHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $markerShapeTest = new MarkerShape();
        $markerShapeTest->setType('poly');
        $markerShapeTest->setCoordinates(array(
            1, 2,
            3, 4,
            5, 6
        ));

        $this->assertEquals(self::$markerShapeHelper->render($markerShapeTest), 'var '.$markerShapeTest->getJavascriptVariable().' = new google.maps.MarkerShape({"type":"poly","coords":[1,2,3,4,5,6]});'.PHP_EOL);

        $markerShapeTest->setType('circle');
        $markerShapeTest->setCoordinates(array(1, 2, 3));

        $this->assertEquals(self::$markerShapeHelper->render($markerShapeTest), 'var '.$markerShapeTest->getJavascriptVariable().' = new google.maps.MarkerShape({"type":"circle","coords":[1,2,3]});'.PHP_EOL);

        $markerShapeTest->setType('rect');
        $markerShapeTest->setCoordinates(array(
            -1, -1,
            1, 1
        ));

        $this->assertEquals(self::$markerShapeHelper->render($markerShapeTest), 'var '.$markerShapeTest->getJavascriptVariable().' = new google.maps.MarkerShape({"type":"rect","coords":[-1,-1,1,1]});'.PHP_EOL);
    }
}
