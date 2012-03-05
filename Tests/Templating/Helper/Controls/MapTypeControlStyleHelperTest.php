<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlStyleHelper;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control style helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlStyleHelper
     */
    protected static $mapTypeControlStyleHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$mapTypeControlStyleHelper = new MapTypeControlStyleHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$mapTypeControlStyleHelper->render(MapTypeControlStyle::DEFAULT_), 'google.maps.MapTypeControlStyle.DEFAULT');
        $this->assertEquals(self::$mapTypeControlStyleHelper->render(MapTypeControlStyle::DROPDOWN_MENU), 'google.maps.MapTypeControlStyle.DROPDOWN_MENU');
        $this->assertEquals(self::$mapTypeControlStyleHelper->render(MapTypeControlStyle::HORIZONTAL_BAR), 'google.maps.MapTypeControlStyle.HORIZONTAL_BAR');

        $this->setExpectedException('InvalidArgumentException');
        self::$mapTypeControlStyleHelper->render('foo');
    }
}
