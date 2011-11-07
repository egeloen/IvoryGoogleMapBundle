<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Events;

use Ivory\GoogleMapBundle\Model\Events\MouseEvent;

/**
 * Mouse event test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MouseEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $mouseEvent = new MouseEvent();
            $this->fail('The class "\Ivory\GoogleMapBundle\Model\Events\MouseEvent" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the map type control styles getter
     */
    public function testMapTypeControlStyles()
    {
        $this->assertEquals(MouseEvent::getMouseEvents(), array(
            MouseEvent::CLICK,
            MouseEvent::DBLCLICK,
            MouseEvent::MOUSEUP,
            MouseEvent::MOUSEDOWN,
            MouseEvent::MOUSEOVER,
            MouseEvent::MOUSEOUT
        ));
    }
}
