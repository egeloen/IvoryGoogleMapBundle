<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Base;

use Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Size helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper
     */
    protected static $sizeHelper = null;

    /**
     * @override
     */
    protected function setUp()
    {
        self::$sizeHelper = new SizeHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $sizeTest = new Size(1.1, 2.1);
        $this->assertEquals(self::$sizeHelper->render($sizeTest), 'new google.maps.Size(1.1, 2.1)');

        $sizeTest = new Size(1.1, 2.1, 'px', 'px');
        $this->assertEquals(self::$sizeHelper->render($sizeTest), 'new google.maps.Size(1.1, 2.1, "px", "px")');
    }
}
