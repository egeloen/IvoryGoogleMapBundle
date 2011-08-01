<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Event as BaseEvent;

/**
 * Event entity which describes a google map event
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event extends BaseEvent
{
    /**
     * Create an event
     */
    public function __construct($instance, $eventName, $handle, $capture = false)
    {
        parent::__construct($instance, $eventName, $handle, $capture);
    }
}
