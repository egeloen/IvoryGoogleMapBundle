<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Base;

use Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Bound helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper
     */
    protected static $boundHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$boundHelper = new BoundHelper(new CoordinateHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $boundTest = new Bound();
        $this->assertEquals(self::$boundHelper->render($boundTest), 'var '.$boundTest->getJavascriptVariable().' = new google.maps.LatLngBounds();'.PHP_EOL);

        $boundTest = new Bound();
        $boundTest->setSouthWest(new Coordinate(-1.1, -2.1, false));
        $boundTest->setNorthEast(new Coordinate(1.1, 2.1, true));
        $this->assertEquals(self::$boundHelper->render($boundTest), 'var '.$boundTest->getJavascriptVariable().' = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, false), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL);
    }

    /**
     * Checks the render extends methos
     */
    public function testRenderExtends()
    {
        $boundTest = new Bound();

        $circleTest = new Overlays\Circle();
        $boundTest->extend($circleTest);

        $groundOverlayTest = new Overlays\GroundOverlay();
        $boundTest->extend($groundOverlayTest);

        $infoWindowTest = new Overlays\InfoWindow();
        $boundTest->extend($infoWindowTest);

        $markerTest = new Overlays\Marker();
        $boundTest->extend($markerTest);

        $polygonTest = new Overlays\Polygon();
        $boundTest->extend($polygonTest);

        $polylineTest = new Overlays\Polyline();
        $boundTest->extend($polylineTest);

        $rectangleTest = new Overlays\Rectangle();
        $boundTest->extend($rectangleTest);

        $this->assertEquals(self::$boundHelper->renderExtends($boundTest),
            $boundTest->getJavascriptVariable().'.union('.$circleTest->getJavascriptVariable().'.getBounds());'.PHP_EOL.
            $boundTest->getJavascriptVariable().'.union('.$groundOverlayTest->getBound()->getJavascriptVariable().');'.PHP_EOL.
            $boundTest->getJavascriptVariable().'.extend('.$infoWindowTest->getJavascriptVariable().'.getPosition());'.PHP_EOL.
            $boundTest->getJavascriptVariable().'.extend('.$markerTest->getJavascriptVariable().'.getPosition());'.PHP_EOL.
            $polygonTest->getJavascriptVariable().'.getPath().forEach(function(element){'.$boundTest->getJavascriptVariable().'.extend(element)});'.PHP_EOL.
            $polylineTest->getJavascriptVariable().'.getPath().forEach(function(element){'.$boundTest->getJavascriptVariable().'.extend(element)});'.PHP_EOL.
            $boundTest->getJavascriptVariable().'.union('.$rectangleTest->getBound()->getJavascriptVariable().');'.PHP_EOL
        );
    }
}
