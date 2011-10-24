<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Events\EventManager as BaseEventManager;

/**
 * Event manager entity which manages the google map event
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManager extends BaseEventManager
{
    /**
     * Create an event manager
     */
    public function __construct()
    {
        parent::__construct();
    }
}
