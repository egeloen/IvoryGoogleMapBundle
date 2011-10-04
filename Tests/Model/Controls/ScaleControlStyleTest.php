<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControlStyle;

/**
 * Scale control style test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlStyleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testContruct()
    {
        $this->setExpectedException('Exception');
        $scaleControlStyleTest = new ScaleControlStyle();
    }
    
    /**
     * Checks the scale styles getter
     */
    public function testScaleControlStyles()
    {
        $this->assertEquals(ScaleControlStyle::getScaleControlStyles(), array(
            ScaleControlStyle::DEFAULT_
        ));
    }
}
