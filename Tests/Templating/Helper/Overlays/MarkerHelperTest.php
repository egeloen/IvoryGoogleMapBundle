<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays as OverlaysHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base as BaseHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Overlays;
use Ivory\GoogleMapBundle\Model\Base;

/**
 * Marker helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerHelper
     */
    protected static $markerHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$markerHelper = new OverlaysHelper\MarkerHelper(
            new BaseHelper\CoordinateHelper(),
            new OverlaysHelper\AnimationHelper(),
            new OverlaysHelper\InfoWindowHelper(new BaseHelper\CoordinateHelper()), 
            new OverlaysHelper\MarkerImageHelper(new BaseHelper\PointHelper(), new BaseHelper\SizeHelper()), 
            new OverlaysHelper\MarkerShapeHelper()
        );
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTest = new Map();
        
        $markerTest = new Overlays\Marker();
        $markerTest->setPosition(new Base\Coordinate(1.1, 2.1, true));
        
        $markerTest->setAnimation(Overlays\Animation::BOUNCE);
        
        $iconTest = new Overlays\MarkerImage();
        $iconTest->setUrl('url');
        $markerTest->setIcon($iconTest);
        
        $shadowTest = new Overlays\MarkerImage();
        $shadowTest->setUrl('url');
        $markerTest->setShadow($shadowTest);
        
        $shapeTest = new Overlays\MarkerShape();
        $shapeTest->setType('poly');
        $shapeTest->setCoordinates(array(
            1, 2,
            3, 4
        ));
        $markerTest->setShape($shapeTest);
        
        $infoWindowTest = new Overlays\InfoWindow();
        $infoWindowTest->setContent('content');
        $markerTest->setInfoWindow($infoWindowTest);
        
        $this->assertEquals(self::$markerHelper->render($markerTest, $mapTest), 
            'var '.$markerTest->getIcon()->getJavascriptVariable().' = new google.maps.MarkerImage("url");'.PHP_EOL.
            'var '.$markerTest->getShadow()->getJavascriptVariable().' = new google.maps.MarkerImage("url");'.PHP_EOL.
            'var '.$markerTest->getShape()->getJavascriptVariable().' = new google.maps.MarkerShape({"type":"poly","coords":[1,2,3,4]});'.PHP_EOL.
            'var '.$markerTest->getJavascriptVariable().' = new google.maps.Marker({"map":'.$mapTest->getJavascriptVariable().',"position":new google.maps.LatLng(1.1, 2.1, true), "animation":google.maps.Animation.BOUNCE, "icon":'.$markerTest->getIcon()->getJavascriptVariable().', "shadow":'.$markerTest->getShadow()->getJavascriptVariable().', "shape":'.$markerTest->getShape()->getJavascriptVariable().'});'.PHP_EOL.
            'var '.$markerTest->getInfoWindow()->getJavascriptVariable().' = new google.maps.InfoWindow({"content":"content"});'.PHP_EOL.
            $markerTest->getInfoWindow()->getJavascriptVariable().'.open('.$mapTest->getJavascriptVariable().');'.PHP_EOL
        );
        
        $markerTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));
        
        $this->assertEquals(self::$markerHelper->render($markerTest, $mapTest), 
            'var '.$markerTest->getIcon()->getJavascriptVariable().' = new google.maps.MarkerImage("url");'.PHP_EOL.
            'var '.$markerTest->getShadow()->getJavascriptVariable().' = new google.maps.MarkerImage("url");'.PHP_EOL.
            'var '.$markerTest->getShape()->getJavascriptVariable().' = new google.maps.MarkerShape({"type":"poly","coords":[1,2,3,4]});'.PHP_EOL.
            'var '.$markerTest->getJavascriptVariable().' = new google.maps.Marker({"map":'.$mapTest->getJavascriptVariable().',"position":new google.maps.LatLng(1.1, 2.1, true), "animation":google.maps.Animation.BOUNCE, "icon":'.$markerTest->getIcon()->getJavascriptVariable().', "shadow":'.$markerTest->getShadow()->getJavascriptVariable().', "shape":'.$markerTest->getShape()->getJavascriptVariable().',"option1":"value1","option2":"value2"});'.PHP_EOL.
            'var '.$markerTest->getInfoWindow()->getJavascriptVariable().' = new google.maps.InfoWindow({"content":"content"});'.PHP_EOL.
            $markerTest->getInfoWindow()->getJavascriptVariable().'.open('.$mapTest->getJavascriptVariable().');'.PHP_EOL
        );
    }
}
