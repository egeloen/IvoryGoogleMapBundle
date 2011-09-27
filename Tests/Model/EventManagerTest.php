<?php

namespace Ivory\GoogleMapBundle\Tests\Model;

use Ivory\GoogleMapBundle\Model\EventManager;
use Ivory\GoogleMapBundle\Model\Event;

/**
 * Event manager test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Model\EventManager Tested event manager
     */
    protected static $eventManager = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$eventManager = new EventManager();
    }
    
    /**
     * Checks the event manager default value
     */
    public function testDefaultValues()
    {
        $this->assertEquals(count(self::$eventManager->getDomEvents()), 0);
        $this->assertEquals(count(self::$eventManager->getDomEventsOnce()), 0);
        $this->assertEquals(count(self::$eventManager->getEvents()), 0);
        $this->assertEquals(count(self::$eventManager->getEventsOnce()), 0);
    }
    
    /**
     * Checks the dom events getter & setter
     */
    public function testDomEvents()
    {
        $domEventTest = new Event();
        $domEventTest->setInstance('instance');
        $domEventTest->setEventName('event_name');
        $domEventTest->setHandle('handle');
        $domEventTest->setCapture(true);
        
        self::$eventManager->addDomEvent($domEventTest);
        $domEvents = self::$eventManager->getDomEvents();
        $this->assertEquals($domEvents[0]->getInstance(), 'instance');
        $this->assertEquals($domEvents[0]->getEventName(), 'event_name');
        $this->assertEquals($domEvents[0]->getHandle(), 'handle');
        $this->assertTrue($domEvents[0]->isCapture());
    }
    
    /**
     * Checks the dom events once getter & setter
     */
    public function testDomEventsOnce()
    {
        $domEventOnceTest = new Event();
        $domEventOnceTest->setInstance('instance');
        $domEventOnceTest->setEventName('event_name');
        $domEventOnceTest->setHandle('handle');
        $domEventOnceTest->setCapture(true);
        
        self::$eventManager->addDomEventOnce($domEventOnceTest);
        $domEventsOnce = self::$eventManager->getDomEventsOnce();
        $this->assertEquals($domEventsOnce[0]->getInstance(), 'instance');
        $this->assertEquals($domEventsOnce[0]->getEventName(), 'event_name');
        $this->assertEquals($domEventsOnce[0]->getHandle(), 'handle');
        $this->assertTrue($domEventsOnce[0]->isCapture());
    }
    
    /**
     * Checks the events getter & setter
     */
    public function testEvents()
    {
        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        $eventTest->setCapture(true);
        
        self::$eventManager->addEvent($eventTest);
        $events = self::$eventManager->getEvents();
        $this->assertEquals($events[0]->getInstance(), 'instance');
        $this->assertEquals($events[0]->getEventName(), 'event_name');
        $this->assertEquals($events[0]->getHandle(), 'handle');
        $this->assertTrue($events[0]->isCapture());
    }
    
    /**
     * Checks the events once getter & setter
     */
    public function testEventsOnce()
    {
        $eventOnceTest = new Event();
        $eventOnceTest->setInstance('instance');
        $eventOnceTest->setEventName('event_name');
        $eventOnceTest->setHandle('handle');
        $eventOnceTest->setCapture(true);
        
        self::$eventManager->addEventOnce($eventOnceTest);
        $eventsOnce = self::$eventManager->getEventsOnce();
        $this->assertEquals($eventsOnce[0]->getInstance(), 'instance');
        $this->assertEquals($eventsOnce[0]->getEventName(), 'event_name');
        $this->assertEquals($eventsOnce[0]->getHandle(), 'handle');
        $this->assertTrue($eventsOnce[0]->isCapture());
    }
}
