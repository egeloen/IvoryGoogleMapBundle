<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Events\Event as BaseEvent;

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
    public function __construct()
    {
        parent::__construct();
    }
}
