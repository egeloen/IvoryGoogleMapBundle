<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Layers;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;
use Ivory\GoogleMapBundle\Model\Layers\HeatmapLayer;

/**
 * Heatmap Layer test.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class HeatmapLayerTest extends AbstractOptionsAssetTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$object = new HeatmapLayer();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 14), 'heatmap_layer_');
    }
}
