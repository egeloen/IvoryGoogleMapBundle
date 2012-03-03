<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper;

use Ivory\GoogleMapBundle\Model\Overlays\InfoWindow;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Overlays\Marker;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Info window helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper
     */
    protected static $infoWindowHelper = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$infoWindowHelper = new InfoWindowHelper(new CoordinateHelper(), new SizeHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $infoWindowTest = new InfoWindow();
        $infoWindowTest->setPosition(new Coordinate(1.1, 2.1, true));
        $infoWindowTest->setPixelOffset(3, 4, 'px', 'px');
        $infoWindowTest->setContent('content');
        $infoWindowTest->setOpen(true);
        $infoWindowTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertEquals(self::$infoWindowHelper->render($infoWindowTest, false), 'var '.$infoWindowTest->getJavascriptVariable().' = new google.maps.InfoWindow({"pixelOffset":new google.maps.Size(3, 4, "px", "px"),"content":"content","option1":"value1","option2":"value2"});'.PHP_EOL);
        $this->assertEquals(self::$infoWindowHelper->render($infoWindowTest, true), 'var '.$infoWindowTest->getJavascriptVariable().' = new google.maps.InfoWindow({"position":new google.maps.LatLng(1.1, 2.1, true),"pixelOffset":new google.maps.Size(3, 4, "px", "px"),"content":"content","option1":"value1","option2":"value2"});'.PHP_EOL);
    }

    /**
     * Checks the render open method
     */
    public function testRenderOpen()
    {
        $mapTest = new Map();

        $infoWindowTest = new InfoWindow();
        $infoWindowTest->setPosition(new Coordinate(1.1, 2.1, true));
        $infoWindowTest->setContent('content');
        $infoWindowTest->setOpen(true);
        $infoWindowTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertEquals(self::$infoWindowHelper->renderOpen($infoWindowTest, $mapTest), $infoWindowTest->getJavascriptVariable().'.open('.$mapTest->getJavascriptVariable().');'.PHP_EOL);

        $markerTest = new Marker();
        $this->assertEquals(self::$infoWindowHelper->renderOpen($infoWindowTest, $mapTest, $markerTest), $infoWindowTest->getJavascriptVariable().'.open('.$mapTest->getJavascriptVariable().', '.$markerTest->getJavascriptVariable().');'.PHP_EOL);
    }
}
