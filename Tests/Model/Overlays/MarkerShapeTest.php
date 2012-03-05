<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractJavascriptVariableAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\MarkerShape;

/**
 * Marker shape test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\MarkerShape Tested marker shape
     */
    protected static $markerShape = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$markerShape = new MarkerShape();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$markerShape->getJavascriptVariable(), 0, 13), 'marker_shape_');
    }

    /**
     * Checks the marker image default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$markerShape->getType(), 'poly');
        $this->assertTrue(self::$markerShape->hasCoordinates());
        $this->assertEquals(self::$markerShape->getCoordinates(), array(1, 1, 1, -1, -1, -1, -1, 1));
    }

    /**
     * Checks the type getter & setter
     */
    public function testType()
    {
        self::$markerShape->setType('circle');
        $this->assertEquals(self::$markerShape->getType(), 'circle');

        self::$markerShape->setType('poly');
        $this->assertEquals(self::$markerShape->getType(), 'poly');

        self::$markerShape->setType('rect');
        $this->assertEquals(self::$markerShape->getType(), 'rect');

        $this->setExpectedException('InvalidArgumentException');
        self::$markerShape->setType('foo');
    }

    /**
     * Checks the cooordinates getter & setter
     */
    public function testCoordinates()
    {
        self::$markerShape->setType('circle');
        self::$markerShape->setCoordinates(array(1, 2, 3));
        $this->assertEquals(self::$markerShape->getCoordinates(), array(1, 2, 3));

        $this->setExpectedException('InvalidArgumentException');
        self::$markerShape->setCoordinates(array('foo'));

        self::$markerShape->setType('poly');
        self::$markerShape->setCoordinates(array(1, 2, 3, 4));
        $this->assertEquals(self::$markerShape->getCoordinates(), array(1, 2, 3, 4));

        self::$markerShape->addCoordinate(5, 6);
        $this->assertEquals(self::$markerShape->getCoordinates(), array(1, 2, 3, 4, 5, 6));

        $this->setExpectedException('InvalidArgumentException');
        self::$markerShape->setCoordinates(array('foo'));

        self::$markerShape->setType('rect');
        self::$markerShape->setCoordinates(array(1, 2, 3, 4));
        $this->assertEquals(self::$markerShape->getCoordinates(), array(1, 2, 3, 4));

        $this->setExpectedException('InvalidArgumentException');
        self::$markerShape->setCoordinates(array('foo'));
    }
}
