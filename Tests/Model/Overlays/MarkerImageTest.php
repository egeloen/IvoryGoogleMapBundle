<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractJavascriptVariableAssetTest;

use Ivory\GoogleMapBundle\Model\Overlays\MarkerImage;
use Ivory\GoogleMapBundle\Model\Base\Point;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Marker image test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\MarkerImage Tested marker image
     */
    protected static $markerImage = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$markerImage = new MarkerImage();
    }

    /**
     * {@inheritdoc}
     */
    public function testJavascriptVariable()
    {
        $this->assertEquals(substr(self::$markerImage->getJavascriptVariable(), 0, 13), 'marker_image_');
    }

    /**
     * Checks the marker image default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(self::$markerImage->getUrl(), '//maps.gstatic.com/mapfiles/markers/marker.png');

        $this->assertFalse(self::$markerImage->hasAnchor());
        $this->assertNull(self::$markerImage->getAnchor());

        $this->assertFalse(self::$markerImage->hasOrigin());
        $this->assertNull(self::$markerImage->getOrigin());

        $this->assertFalse(self::$markerImage->hasScaledSize());
        $this->assertNull(self::$markerImage->getScaledSize());

        $this->assertFalse(self::$markerImage->hasSize());
        $this->assertNull(self::$markerImage->getSize());
    }

    /**
     * Checks the url getter & setter
     */
    public function testUrl()
    {
        self::$markerImage->setUrl('url');
        $this->assertEquals(self::$markerImage->getUrl(), 'url');

        $this->setExpectedException('InvalidArgumentException');
        self::$markerImage->setUrl(0);
    }

    /**
     * Checks the anchor getter & setter
     */
    public function testAnchor()
    {
        $pointTest = new Point(1, 1);
        self::$markerImage->setAnchor($pointTest);
        $this->assertEquals(self::$markerImage->getAnchor()->getX(), 1);
        $this->assertEquals(self::$markerImage->getAnchor()->getY(), 1);

        self::$markerImage->setAnchor(2, 2);
        $this->assertEquals(self::$markerImage->getAnchor()->getX(), 2);
        $this->assertEquals(self::$markerImage->getAnchor()->getY(), 2);

        self::$markerImage->setAnchor(null);
        $this->assertNull(self::$markerImage->getAnchor());

        $this->setExpectedException('InvalidArgumentException');
        self::$markerImage->setAnchor('foo');
    }

    /**
     * Checks the origin getter & setter
     */
    public function testOrigin()
    {
        $pointTest = new Point(1, 1);
        self::$markerImage->setOrigin($pointTest);
        $this->assertEquals(self::$markerImage->getOrigin()->getX(), 1);
        $this->assertEquals(self::$markerImage->getOrigin()->getY(), 1);

        self::$markerImage->setOrigin(2, 2);
        $this->assertEquals(self::$markerImage->getOrigin()->getX(), 2);
        $this->assertEquals(self::$markerImage->getOrigin()->getY(), 2);

        self::$markerImage->setOrigin(null);
        $this->assertNull(self::$markerImage->getOrigin());

        $this->setExpectedException('InvalidArgumentException');
        self::$markerImage->setOrigin('foo');
    }

    /**
     * Checks the scaled size getter & setter
     */
    public function testScaledSize()
    {
        $sizeTest = new Size(1, 1, 'px', 'px');
        self::$markerImage->setScaledSize($sizeTest);
        $this->assertEquals(self::$markerImage->getScaledSize()->getWidth(), 1);
        $this->assertEquals(self::$markerImage->getScaledSize()->getHeight(), 1);
        $this->assertEquals(self::$markerImage->getScaledSize()->getWidthUnit(), 'px');
        $this->assertEquals(self::$markerImage->getScaledSize()->getHeightUnit(), 'px');

        self::$markerImage->setScaledSize(2, 2, 'px', 'px');
        $this->assertEquals(self::$markerImage->getScaledSize()->getWidth(), 2);
        $this->assertEquals(self::$markerImage->getScaledSize()->getHeight(), 2);
        $this->assertEquals(self::$markerImage->getScaledSize()->getWidthUnit(), 'px');
        $this->assertEquals(self::$markerImage->getScaledSize()->getHeightUnit(), 'px');

        self::$markerImage->setScaledSize(null);
        $this->assertNull(self::$markerImage->getScaledSize());

        $this->setExpectedException('InvalidArgumentException');
        self::$markerImage->setScaledSize('foo');
    }

    /**
     * Checks the size getter & setter
     */
    public function testSize()
    {
        $sizeTest = new Size(1, 1, 'px', 'px');
        self::$markerImage->setSize($sizeTest);
        $this->assertEquals(self::$markerImage->getSize()->getWidth(), 1);
        $this->assertEquals(self::$markerImage->getSize()->getHeight(), 1);
        $this->assertEquals(self::$markerImage->getSize()->getWidthUnit(), 'px');
        $this->assertEquals(self::$markerImage->getSize()->getHeightUnit(), 'px');

        self::$markerImage->setSize(2, 2, 'px', 'px');
        $this->assertEquals(self::$markerImage->getSize()->getWidth(), 2);
        $this->assertEquals(self::$markerImage->getSize()->getHeight(), 2);
        $this->assertEquals(self::$markerImage->getSize()->getWidthUnit(), 'px');
        $this->assertEquals(self::$markerImage->getSize()->getHeightUnit(), 'px');

        self::$markerImage->setSize(null);
        $this->assertNull(self::$markerImage->getSize());

        $this->setExpectedException('InvalidArgumentException');
        self::$markerImage->setSize('foo');
    }
}
