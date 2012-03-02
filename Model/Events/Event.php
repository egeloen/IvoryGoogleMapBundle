<?php

namespace Ivory\GoogleMapBundle\Model\Events;

use Ivory\GoogleMapBundle\Model\Assets\AbstractJavascriptVariableAsset;

/**
 * Event which describes a google map event
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event extends AbstractJavascriptVariableAsset
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
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('event_');
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
        if(is_string($instance))
            $this->instance = $instance;
        else
            throw new \InvalidArgumentException('The instance of an event must be a string value.');
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
        if(is_string($eventName))
            $this->eventName = $eventName;
        else
            throw new \InvalidArgumentException('The event name of an event must be a string value.');
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
        if(is_string($handle))
            $this->handle = $handle;
        else
            throw new \InvalidArgumentException('The handle of an event must be a string value.');
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
        if(is_bool($capture))
            $this->capture = $capture;
        else
            throw new \InvalidArgumentException('The capture property of an event must be a boolean value.');
    }
}
