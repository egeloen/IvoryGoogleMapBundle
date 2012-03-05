<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\AnimationHelper;
use Ivory\GoogleMapBundle\Model\Overlays\Animation;

/**
 * Animation helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\AnimationHelper
     */
    protected static $animationHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$animationHelper = new AnimationHelper();
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $this->assertEquals(self::$animationHelper->render(Animation::BOUNCE), 'google.maps.Animation.BOUNCE');
        $this->assertEquals(self::$animationHelper->render(Animation::DROP), 'google.maps.Animation.DROP');

        $this->setExpectedException('InvalidArgumentException');
        self::$animationHelper->render('foo');
    }
}
