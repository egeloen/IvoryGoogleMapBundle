<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlStyleHelper;
use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control style helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlStyleHelper
     */
    protected static $scaleControlStyleHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$scaleControlStyleHelper = new ScaleControlStyleHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$scaleControlStyleHelper->render(ScaleControlStyle::DEFAULT_), 'google.maps.ScaleControlStyle.DEFAULT');

        $this->setExpectedException('InvalidArgumentException');
        self::$scaleControlStyleHelper->render('foo');
    }
}
