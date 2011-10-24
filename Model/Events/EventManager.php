<?php

namespace Ivory\GoogleMapBundle\Model\Events;

/**
 * Event manager which manages the google map event
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManager 
{
    /**
     * @var array Dom events
     */
    protected $domEvents = array();
    
    /**
     * @var array Dom events which are just trigger one time
     */
    protected $domEventsOnce = array();
    
    /**
     * @var array Events
     */
    protected $events = array();
    
    /**
     * @var array Events which are just trigger one time
     */
    protected $eventsOnce = array();
    
    /**
     * Create an event manager
     */
    public function __construct()
    {
        
    }
    
    /**
     * Gets the dom events
     *
     * @return array
     */
    public function getDomEvents()
    {
        return $this->domEvents;
    }
    
    /**
     * Add a dom event
     *
     * @param Ivory\GoogleMapBundle\Model\Events\Event $domEvent 
     */
    public function addDomEvent(Event $domEvent)
    {
        $this->domEvents[] = $domEvent;
    }
    
    /**
     * Gets the dom events which are just trigger one time
     *
     * @return array
     */
    public function getDomEventsOnce()
    {
        return $this->domEventsOnce;
    }
    
    /**
     * Add a dom event which is just trigger one time
     *
     * @param Ivory\GoogleMapBundle\Model\Events\Event $domEventOnce 
     */
    public function addDomEventOnce(Event $domEventOnce)
    {
        $this->domEventsOnce[] = $domEventOnce;
    }
    
    /**
     * Gets the events
     *
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }
    
    /**
     * Add an event
     *
     * @param Ivory\GoogleMapBundle\Model\Events\Event $event 
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }
    
    /**
     * Gets the event which are just trigger one time
     *
     * @return array
     */
    public function getEventsOnce()
    {
        return $this->eventsOnce;
    }
    
    /**
     * Add an event which is just trigger one time
     *
     * @param Ivory\GoogleMapBundle\Model\Events\Event $eventOnce 
     */
    public function addEventOnce(Event $eventOnce)
    {
        $this->eventsOnce[] = $eventOnce;
    }
}
