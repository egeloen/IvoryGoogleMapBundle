<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays\GroundOverlay;
use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Ground overlay helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper
     */
    protected static $groundOverlayHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$groundOverlayHelper = new GroundOverlayHelper(new BoundHelper(new CoordinateHelper()));
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        
        $boundTest = new Bound();
        $boundTest->setSouthWest(new Coordinate(-1.1, -2.1, true));
        $boundTest->setNorthEast(new Coordinate(1.1, 2.1, true));
     
        $groundOverlayTest = new GroundOverlay();
        $groundOverlayTest->setUrl('url');
        $groundOverlayTest->setBound($boundTest);
        
        $this->assertEquals(self::$groundOverlayHelper->render($groundOverlayTest, $mapTest),
            'var '.$groundOverlayTest->getBound()->getJavascriptVariable().' = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL.
            'var '.$groundOverlayTest->getJavascriptVariable().' = new google.maps.GroundOverlay("'.$groundOverlayTest->getUrl().'", '.$groundOverlayTest->getBound()->getJavascriptVariable().', {"map":'.$mapTest->getJavascriptVariable().'});'.PHP_EOL
        );
        
        $groundOverlayTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$groundOverlayHelper->render($groundOverlayTest, $mapTest),
            'var '.$groundOverlayTest->getBound()->getJavascriptVariable().' = new google.maps.LatLngBounds(new google.maps.LatLng(-1.1, -2.1, true), new google.maps.LatLng(1.1, 2.1, true));'.PHP_EOL.
            'var '.$groundOverlayTest->getJavascriptVariable().' = new google.maps.GroundOverlay("'.$groundOverlayTest->getUrl().'", '.$groundOverlayTest->getBound()->getJavascriptVariable().', {"map":'.$mapTest->getJavascriptVariable().',"option1":"value1","option2":"value2"});'.PHP_EOL
        );
    }
}
