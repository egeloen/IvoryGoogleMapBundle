<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractOptionsAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\Marker;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Overlays\Animation;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerImage;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerShape;
use Ivory\GoogleMapBundle\Model\Overlays\InfoWindow;

/**
 * Marker test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends AbstractOptionsAssetTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$object = new Marker();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$object->getJavascriptVariable(), 0, 7), 'marker_');
    }

    /**
     * {@inheritdoc}
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();

        $this->assertEquals(self::$object->getPosition()->getLatitude(), 0);
        $this->assertEquals(self::$object->getPosition()->getLongitude(), 0);
        $this->assertTrue(self::$object->getPosition()->isNoWrap());

        $this->assertFalse(self::$object->hasAnimation());
        $this->assertNull(self::$object->getAnimation());

        $this->assertFalse(self::$object->hasIcon());
        $this->assertNull(self::$object->getIcon());

        $this->assertFalse(self::$object->hasShadow());
        $this->assertNull(self::$object->getShadow());

        $this->assertFalse(self::$object->hasShape());
        $this->assertNull(self::$object->getShape());

        $this->assertFalse(self::$object->hasInfoWindow());
        $this->assertNull(self::$object->getInfoWindow());
    }

    /**
     * Checks the position getter & setter
     */
    public function testPosition()
    {
        $coordinateTest = new Coordinate(1.1, 1.1, true);
        self::$object->setPosition($coordinateTest);
        $this->assertEquals(self::$object->getPosition()->getLatitude(), 1.1);
        $this->assertEquals(self::$object->getPosition()->getLongitude(), 1.1);
        $this->assertTrue(self::$object->getPosition()->isNoWrap());

        self::$object->setPosition(2.1, 2.1, false);
        $this->assertEquals(self::$object->getPosition()->getLatitude(), 2.1);
        $this->assertEquals(self::$object->getPosition()->getLongitude(), 2.1);
        $this->assertFalse(self::$object->getPosition()->isNoWrap());

        self::$object->setPosition(null);
        $this->assertNull(self::$object->getPosition());

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setPosition('foo');
    }

    /**
     * Checks the animation getter & setter
     */
    public function testAnimation()
    {
        self::$object->setAnimation(Animation::BOUNCE);
        $this->assertEquals(self::$object->getAnimation(), 'bounce');

        self::$object->setAnimation(null);
        $this->assertNull(self::$object->getAnimation());

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setAnimation('foo');
    }

    /**
     * Checks the icon getter & setter
     */
    public function testIcon()
    {
        self::$object->setIcon('url');
        $this->assertEquals(self::$object->getIcon()->getUrl(), 'url');
        $this->assertNull(self::$object->getIcon()->getAnchor());
        $this->assertNull(self::$object->getIcon()->getOrigin());
        $this->assertNull(self::$object->getIcon()->getScaledSize());
        $this->assertNull(self::$object->getIcon()->getSize());

        $markerImageTest = new MarkerImage();
        $markerImageTest->setUrl('url');
        self::$object->setIcon($markerImageTest);
        $this->assertEquals(self::$object->getIcon()->getUrl(), 'url');
        $this->assertNull(self::$object->getIcon()->getAnchor());
        $this->assertNull(self::$object->getIcon()->getOrigin());
        $this->assertNull(self::$object->getIcon()->getScaledSize());
        $this->assertNull(self::$object->getIcon()->getSize());

        $markerImageTest = new MarkerImage();
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setIcon($markerImageTest);

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setIcon(0);
    }

    /**
     * Checks the shadow getter & setter
     */
    public function testShadow()
    {
        self::$object->setShadow('url');
        $this->assertEquals(self::$object->getShadow()->getUrl(), 'url');
        $this->assertNull(self::$object->getShadow()->getAnchor());
        $this->assertNull(self::$object->getShadow()->getOrigin());
        $this->assertNull(self::$object->getShadow()->getScaledSize());
        $this->assertNull(self::$object->getShadow()->getSize());

        $markerImageTest = new MarkerImage();
        $markerImageTest->setUrl('url');
        self::$object->setShadow($markerImageTest);
        $this->assertEquals(self::$object->getShadow()->getUrl(), 'url');
        $this->assertNull(self::$object->getShadow()->getAnchor());
        $this->assertNull(self::$object->getShadow()->getOrigin());
        $this->assertNull(self::$object->getShadow()->getScaledSize());
        $this->assertNull(self::$object->getShadow()->getSize());

        $markerImageTest = new MarkerImage();
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setShadow($markerImageTest);

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setShadow(0);
    }

    /**
     * Checks the shape getter & setter
     */
    public function testShape()
    {
        $markerShapeTest = new MarkerShape();
        $markerShapeTest->setCoordinates(array(1, 2, 3, 4));
        self::$object->setShape($markerShapeTest);
        $this->assertEquals(self::$object->getShape()->getType(), 'poly');
        $this->assertEquals(self::$object->getShape()->getCoordinates(), array(1, 2, 3, 4));

        self::$object->setShape('rect', array(1, 2, 3, 4));
        $this->assertEquals(self::$object->getShape()->getType(), 'rect');
        $this->assertEquals(self::$object->getShape()->getCoordinates(), array(1, 2, 3, 4));

        $this->setExpectedException('InvalidArgumentException');
        self::$object->setShape('foo');
    }

    /**
     * Checks the info window getter & setter
     */
    public function testInfoWindow()
    {
        $infoWindowTest = new InfoWindow();
        self::$object->setInfoWindow($infoWindowTest);
        $this->assertNull(self::$object->getInfoWindow()->getPosition());
        $this->assertEquals(self::$object->getInfoWindow()->getContent(), '<p>Default content</p>');
        $this->assertFalse(self::$object->getInfoWindow()->isOpen());
    }
}
