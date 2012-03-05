<?php

namespace Ivory\GoogleMapBundle\Tests\Layers;

use Ivory\GoogleMapBundle\Templating\Helper\Layers\KMLLayerHelper;

use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Layers\KMLLayer;

/**
 * KML Layer helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerHelperTest extends \PHPUnit_Framework_TestCase
{
    protected static $kmlLayerHelper;

    public function setUp()
    {
        self::$kmlLayerHelper = new KMLLayerHelper();
    }

    public function testRender()
    {
        $mapTest = new Map();

        $kmlLayerTest = new KMLLayer();
        $kmlLayerTest->setUrl('url');

        $this->assertEquals(self::$kmlLayerHelper->render($kmlLayerTest, $mapTest),
            'var '.$kmlLayerTest->getJavascriptVariable().' = new google.maps.KmlLayer("'.$kmlLayerTest->getUrl().'", {"map":'.$mapTest->getJavascriptVariable().'});'.PHP_EOL
        );

        $kmlLayerTest->setOptions(array(
            'option1' => 'value1',
            'option2' => 'value2'
        ));

        $this->assertEquals(self::$kmlLayerHelper->render($kmlLayerTest, $mapTest),
            'var '.$kmlLayerTest->getJavascriptVariable().' = new google.maps.KmlLayer("'.$kmlLayerTest->getUrl().'", {"map":'.$mapTest->getJavascriptVariable().',"option1":"value1","option2":"value2"});'.PHP_EOL
        );
    }
}
