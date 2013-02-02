<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Layers;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Heatmap layer service test
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class HeatmapLayerServiceTest extends WebTestCase
{
    /**
     * Checks the heatmap layer service without configuration
     */
    public function testBoundServiceWithoutConfiguration()
    {
        $heatmapLayer = self::createContainer()->get('ivory_google_map.heatmap_layer');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Layers\HeatmapLayer', $heatmapLayer);
        $this->assertEquals(substr($heatmapLayer->getJavascriptVariable(), 0, 14), 'heatmap_layer_');
        $this->assertEmpty($heatmapLayer->getOptions());
    }

    /**
     * Checks the heatmap layer service with configuration
     */
    public function testBoundServiceWithConfiguration()
    {
        $heatmapLayer = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.heatmap_layer');

        $this->assertEquals(substr($heatmapLayer->getJavascriptVariable(), 0, 14), 'heatmap_layer_');
        $this->assertEquals(array(), $heatmapLayer->getOptions());
    }
}
