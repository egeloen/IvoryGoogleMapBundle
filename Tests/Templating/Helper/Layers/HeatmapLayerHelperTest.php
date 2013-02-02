<?php

namespace Ivory\GoogleMapBundle\Tests\Layers;

use Ivory\GoogleMapBundle\Templating\Helper\Layers\HeatmapLayerHelper;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Layers\HeatmapLayer;
use Zend\Json\Expr;
use Zend\Json\Json;

/**
 * Heatmap layer helper test.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class HeatmapLayerHelperTest extends \PHPUnit_Framework_TestCase
{
    protected static $heatmapLayerHelper;

    public function setUp()
    {
        self::$heatmapLayerHelper = new HeatmapLayerHelper();
    }

    public function testRender()
    {
        $mapTest = new Map();

        $heatmapLayerTest = new HeatmapLayer();

        $this->assertEquals(self::$heatmapLayerHelper->render($heatmapLayerTest, $mapTest),
            'var '.$heatmapLayerTest->getJavascriptVariable().' = new google.maps.visualization.HeatmapLayer({"data":'.Json::encode($heatmapLayerTest->getOptions(), false, array('enableJsonExprFinder' => true)).',"map":'.$mapTest->getJavascriptVariable().'});'.PHP_EOL
        );

        $options = array(
            'option1' => 'value1',
            'option2' => 'value2'
        );

        $heatmapLayerTest->setOptions($options);

        $options['data'] = array();
        $options['map'] = new Expr($mapTest->getJavascriptVariable());

        $this->assertEquals(self::$heatmapLayerHelper->render($heatmapLayerTest, $mapTest),
            'var '.$heatmapLayerTest->getJavascriptVariable().' = new google.maps.visualization.HeatmapLayer('.Json::encode($options, false, array('enableJsonExprFinder' => true)).');'.PHP_EOL
        );
    }
}
