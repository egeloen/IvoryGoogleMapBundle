<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Layers;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * KML layer service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerServiceTest extends WebTestCase
{
    /**
     * Checks the KML layer service without configuration
     */
    public function testBoundServiceWithoutConfiguration()
    {
        $kmlLayer = self::createContainer()->get('ivory_google_map.kml_layer');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Layers\KMLLayer', $kmlLayer);
        $this->assertEquals(substr($kmlLayer->getJavascriptVariable(), 0, 10), 'kml_layer_');
        $this->assertEmpty($kmlLayer->getUrl());
        $this->assertEmpty($kmlLayer->getOptions());
    }

    /**
     * Checks the KML layer service with configuration
     */
    public function testBoundServiceWithConfiguration()
    {
        $kmlLayer = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.kml_layer');

        $this->assertEquals(substr($kmlLayer->getJavascriptVariable(), 0, 2), 'kl');
        $this->assertEquals('url', $kmlLayer->getUrl());
        $this->assertEquals(array('option' => 'value'), $kmlLayer->getOptions());
    }
}
