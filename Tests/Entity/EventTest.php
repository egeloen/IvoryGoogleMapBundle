<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\Event;

/**
 * Event entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the event constuctor
     */
    public function testConstructor()
    {
        $eventEntityTest = new Event();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Events\Event', $eventEntityTest);
    }
}
