<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Events;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Event manager builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerBuilder extends AbstractBuilder
{
    /** @var array */
    protected $domEvents;

    /** @var array */
    protected $domEventsOnce;

    /** @var array */
    protected $events;

    /** @var array */
    protected $eventsOnce;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Gets the dom events.
     *
     * @return array The dom events.
     */
    public function getDomEvents()
    {
        return $this->domEvents;
    }

    /**
     * Sets the dom events.
     *
     * @param array $domEvents The dom events.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder The builder.
     */
    public function setDomEvents(array $domEvents)
    {
        $this->domEvents = $domEvents;

        return $this;
    }

    /**
     * Gets the dom events once.
     *
     * @return array he dom events once.
     */
    public function getDomEventsOnce()
    {
        return $this->domEventsOnce;
    }

    /**
     * Sets the dom events once.
     *
     * @param array $domEventsOnce The dom events once.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder The builder.
     */
    public function setDomEventsOnce(array $domEventsOnce)
    {
        $this->domEventsOnce = $domEventsOnce;

        return $this;
    }

    /**
     * Gets the events.
     *
     * @return array The events.
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Sets the events.
     *
     * @param array $events The events.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder The builder.
     */
    public function setEvents(array $events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * Gets the events once.
     *
     * @return array The events once.
     */
    public function getEventsOnce()
    {
        return $this->eventsOnce;
    }

    /**
     * Sets the events once.
     *
     * @param array $eventsOnce The events once.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventManagerBuilder The builder.
     */
    public function setEventsOnce(array $eventsOnce)
    {
        $this->eventsOnce = $eventsOnce;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->domEvents = array();
        $this->domEventsOnce = array();
        $this->events = array();
        $this->eventsOnce = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Events\EventManager The event manager.
     */
    public function build()
    {
        $eventManager = new $this->class();

        foreach ($this->domEvents as $domEvent) {
            $eventManager->addDomEvent($domEvent);
        }

        foreach ($this->domEventsOnce as $domEventOnce) {
            $eventManager->addDomEventOnce($domEventOnce);
        }

        foreach ($this->events as $event) {
            $eventManager->addEvent($event);
        }

        foreach ($this->eventsOnce as $eventOnce) {
            $eventManager->addEventOnce($eventOnce);
        }

        return $eventManager;
    }
}
