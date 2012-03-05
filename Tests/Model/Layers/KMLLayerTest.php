<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Layers;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;
use Ivory\GoogleMapBundle\Model\Layers\KMLLayer;

/**
 * KML Layer test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerTest extends AbstractOptionsAssetTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$object = new KMLLayer();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 10), 'kml_layer_');
    }

    /**
     * {@inheritdoc}
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();

        $this->assertNull(self::$object->getUrl());
    }

    /**
     * Checks the url getter & setter
     */
    public function testUrl()
    {
        self::$object->setUrl('url');

        $this->assertEquals(self::$object->getUrl(), 'url');
    }
}
