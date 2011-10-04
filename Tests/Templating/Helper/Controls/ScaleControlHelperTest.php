<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlStyleHelper;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControl;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlHelper
     */
    protected static $scaleControlHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$scaleControlHelper = new ScaleControlHelper(new ControlPositionHelper(), new ScaleControlStyleHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $scaleControlTest = new ScaleControl();
        $scaleControlTest->setControlPosition(ControlPosition::BOTTOM_CENTER);
        $scaleControlTest->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
        
        $this->assertEquals(self::$scaleControlHelper->render($scaleControlTest), '{"position":google.maps.ControlPosition.BOTTOM_CENTER,"style":google.maps.ScaleControlStyle.DEFAULT}');
    }
}
