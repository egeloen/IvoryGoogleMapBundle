<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\EventManager;

/**
 * Event manager entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the event manager constuctor
     */
    public function testConstructor()
    {
        $eventManagerEntityTest = new EventManager();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Events\EventManager', $eventManagerEntityTest);
    }
}
