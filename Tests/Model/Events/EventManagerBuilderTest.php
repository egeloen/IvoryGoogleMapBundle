<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Events;

use Ivory\GoogleMapBundle\Model\Events\EventBuilder;
use Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder;

/**
 * Event manager builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder */
    protected $eventManagerBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Events\EventBuilder */
    protected $eventBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventBuilder = new EventBuilder('Ivory\GoogleMap\Events\Event');
        $this->eventManagerBuilder = new EventManagerBuilder('Ivory\GoogleMap\Events\EventManager');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventBuilder);
        unset($this->eventManagerBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Events\EventManager', $this->eventManagerBuilder->getClass());
        $this->assertEmpty($this->eventManagerBuilder->getDomEvents());
        $this->assertEmpty($this->eventManagerBuilder->getDomEventsOnce());
        $this->assertEmpty($this->eventManagerBuilder->getEvents());
        $this->assertEmpty($this->eventManagerBuilder->getEventsOnce());
    }

    public function testSingleBuildWithoutValues()
    {
        $eventManager = $this->eventManagerBuilder->build();

        $this->assertEmpty($eventManager->getDomEvents());
        $this->assertEmpty($eventManager->getDomEventsOnce());
        $this->assertEmpty($eventManager->getEvents());
        $this->assertEmpty($eventManager->getEventsOnce());
    }

    public function testSingleBuildWithValues()
    {
        $domEvents = array($this->eventBuilder->build());
        $domEventsOnce = array($this->eventBuilder->build());
        $events = array($this->eventBuilder->build());
        $eventsOnce = array($this->eventBuilder->build());

        $this->eventManagerBuilder
            ->setDomEvents($domEvents)
            ->setDomEventsOnce($domEventsOnce)
            ->setEvents($events)
            ->setEventsOnce($eventsOnce);

        $eventManager = $this->eventManagerBuilder->build();

        $this->assertSame($domEvents, $eventManager->getDomEvents());
        $this->assertSame($domEventsOnce, $eventManager->getDomEventsOnce());
        $this->assertSame($events, $eventManager->getEvents());
        $this->assertSame($eventsOnce, $eventManager->getEventsOnce());
    }

    public function testMultipleBuildWithoutReset()
    {
        $domEvents = array($this->eventBuilder->build());
        $domEventsOnce = array($this->eventBuilder->build());
        $events = array($this->eventBuilder->build());
        $eventsOnce = array($this->eventBuilder->build());

        $this->eventManagerBuilder
            ->setDomEvents($domEvents)
            ->setDomEventsOnce($domEventsOnce)
            ->setEvents($events)
            ->setEventsOnce($eventsOnce);

        $eventManager1 = $this->eventManagerBuilder->build();
        $eventManager2 = $this->eventManagerBuilder->build();

        $this->assertNotSame($eventManager1, $eventManager2);

        $this->assertSame($domEvents, $eventManager1->getDomEvents());
        $this->assertSame($domEventsOnce, $eventManager1->getDomEventsOnce());
        $this->assertSame($events, $eventManager1->getEvents());
        $this->assertSame($eventsOnce, $eventManager1->getEventsOnce());

        $this->assertSame($domEvents, $eventManager2->getDomEvents());
        $this->assertSame($domEventsOnce, $eventManager2->getDomEventsOnce());
        $this->assertSame($events, $eventManager2->getEvents());
        $this->assertSame($eventsOnce, $eventManager2->getEventsOnce());
    }

    public function testMultipleBuildWithReset()
    {
        $domEvents = array($this->eventBuilder->build());
        $domEventsOnce = array($this->eventBuilder->build());
        $events = array($this->eventBuilder->build());
        $eventsOnce = array($this->eventBuilder->build());

        $this->eventManagerBuilder
            ->setDomEvents($domEvents)
            ->setDomEventsOnce($domEventsOnce)
            ->setEvents($events)
            ->setEventsOnce($eventsOnce);

        $eventManager1 = $this->eventManagerBuilder->build();
        $this->eventManagerBuilder->reset();
        $eventManager2 = $this->eventManagerBuilder->build();

        $this->assertNotSame($eventManager1, $eventManager2);

        $this->assertSame($domEvents, $eventManager1->getDomEvents());
        $this->assertSame($domEventsOnce, $eventManager1->getDomEventsOnce());
        $this->assertSame($events, $eventManager1->getEvents());
        $this->assertSame($eventsOnce, $eventManager1->getEventsOnce());

        $this->assertEmpty($eventManager2->getDomEvents());
        $this->assertEmpty($eventManager2->getDomEventsOnce());
        $this->assertEmpty($eventManager2->getEvents());
        $this->assertEmpty($eventManager2->getEventsOnce());
    }
}
