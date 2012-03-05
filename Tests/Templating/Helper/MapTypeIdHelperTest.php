<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper;
use Ivory\GoogleMapBundle\Model\MapTypeId;

/**
 * Map type ID helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper
     */
    protected static $mapTypeIdHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$mapTypeIdHelper = new MapTypeIdHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$mapTypeIdHelper->render(MapTypeId::HYBRID), 'google.maps.MapTypeId.HYBRID');
        $this->assertEquals(self::$mapTypeIdHelper->render(MapTypeId::ROADMAP), 'google.maps.MapTypeId.ROADMAP');
        $this->assertEquals(self::$mapTypeIdHelper->render(MapTypeId::SATELLITE), 'google.maps.MapTypeId.SATELLITE');
        $this->assertEquals(self::$mapTypeIdHelper->render(MapTypeId::TERRAIN), 'google.maps.MapTypeId.TERRAIN');

        $this->setExpectedException('InvalidArgumentException');
        self::$mapTypeIdHelper->render('foo');
    }
}
