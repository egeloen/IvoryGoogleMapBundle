<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlStyleHelper;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControl;
use Ivory\GoogleMapBundle\Model\MapTypeId;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlHelper
     */
    protected static $mapTypeControlHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$mapTypeControlHelper = new MapTypeControlHelper(new MapTypeIdHelper(), new ControlPositionHelper(), new MapTypeControlStyleHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $mapTypeControlTest = new MapTypeControl();
        $mapTypeControlTest->setMapTypeIds(array(MapTypeId::ROADMAP));
        $mapTypeControlTest->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $mapTypeControlTest->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);

        $this->assertEquals(self::$mapTypeControlHelper->render($mapTypeControlTest), '{"mapTypeIds":[google.maps.MapTypeId.ROADMAP],"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.MapTypeControlStyle.DROPDOWN_MENU}');
    }
}
