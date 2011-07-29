<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Event which describes a google map event
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event 
{
    /**
     * @var string Event object instance
     */
    protected $instance = null;
    
    /**
     * @var string Event name
     */
    protected $eventName = null;
    
    /**
     * @var string Event function handle
     */
    protected $handle = null;
    
    /**
     * @var boolean TRUE if the event is capture else FALSE
     */
    protected $capture = false;
    
    /**
     * Create an event
     *
     * @param string $instance
     * @param string $eventName
     * @param string $handle
     * @param boolean $capture 
     */
    public function __construct($instance, $eventName, $handle, $capture = false)
    {
        $this->instance = $instance;
        $this->eventName = $eventName;
        $this->handle = $handle;
        $this->capture = $capture;
    }
    
    /**
     * Gets the event object instance
     *
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }
    
    /**
     * Sets the event object instance
     *
     * @param string $instance 
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }
    
    /**
     * Gets the event name
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }
    
    /**
     * Sets the event name
     *
     * @param string $eventName 
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }
    
    /**
     * Gets the event function handle
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }
    
    /**
     * Sets the event function handle
     *
     * @param string $handle 
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }
    
    /**
     * Checks if the event is capture
     *
     * @return boolean TRUE if the event is capture else FALSE
     */
    public function isCapture()
    {
        return $this->capture;
    }
    
    /**
     * Sets if the event is capture
     *
     * @param boolean $capture TRUE if the event is capture else FALSE
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }
}
