<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Overlays\Animation;

/**
 * Animation test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AnimationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constuctor
     */
    public function testConstruct()
    {
        $this->setExpectedException('Exception');
        $animationTest = new Animation();
    }
    
    /**
     * Checks the animation getter
     */
    public function testAnimations()
    {
        $this->assertEquals(Animation::getAnimations(), array(
            Animation::BOUNCE,
            Animation::DROP
        ));
    }
}
