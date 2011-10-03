<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\OverviewMapControlHelper;
use Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl;

/**
 * Overview map control helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\OverviewMapControlHelper
     */
    protected static $overviewMapControlHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$overviewMapControlHelper = new OverviewMapControlHelper();
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $overviewMapControl = new OverviewMapControl();
        $overviewMapControl->setOpened(true);
        $this->assertEquals(self::$overviewMapControlHelper->render($overviewMapControl), '{"opened":true}');
    }
}
