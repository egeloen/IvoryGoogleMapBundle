<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Overlays;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Marker shape service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeServiceTest extends WebTestCase
{
    /**
     * Checks the marker shape service without configuration
     */
    public function testMarkerShapeServiceWithoutConfiguration()
    {
        $markerShape = self::createContainer()->get('ivory_google_map.marker_shape');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Overlays\MarkerShape', $markerShape);
        $this->assertEquals(substr($markerShape->getJavascriptVariable(), 0, 13), 'marker_shape_');
        $this->assertEquals($markerShape->getType(), 'poly');
        $this->assertTrue($markerShape->hasCoordinates());
        $this->assertEquals($markerShape->getCoordinates(), array(1, 1, 1, -1, -1, -1, -1, 1));
    }

    /**
     * Checks the  marker shape service with configuration
     */
    public function testMarkerShapeServiceWithConfiguration()
    {
        $markerShape = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.marker_shape');

        $this->assertEquals(substr($markerShape->getJavascriptVariable(), 0, 2), 'ms');
        $this->assertEquals($markerShape->getType(), 'rect');
        $this->assertTrue($markerShape->hasCoordinates());
        $this->assertEquals($markerShape->getCoordinates(), array(-1.1, -2.1, 2.1, 1.1));
    }
}
