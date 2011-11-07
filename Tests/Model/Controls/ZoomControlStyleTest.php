<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle;

/**
 * Zoom control style test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlStyleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testContruct()
    {
        try
        {
            $zoomControlStyleTest = new ZoomControlStyle();
            $this->fail('The class "\Ivory\GoogleMapBundle\Model\Controls\ZoomControlStyle" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the zoom styles getter
     */
    public function testZoomControlStyles()
    {
        $this->assertEquals(ZoomControlStyle::getZoomControlStyles(), array(
            ZoomControlStyle::DEFAULT_,
            ZoomControlStyle::LARGE,
            ZoomControlStyle::SMALL
        ));
    }
}
