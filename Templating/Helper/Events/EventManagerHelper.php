<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Events;

use Ivory\GoogleMapBundle\Model\Events\EventManager;

/**
 * Event manager helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelper 
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Events\EventHelper
     */
    protected $eventHelper = null;
    
    /**
     * Creates an event manager helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Events\EventHelper $eventHelper 
     */
    public function __construct(EventHelper $eventHelper)
    {
        $this->eventHelper = $eventHelper;
    }
    
    /**
     * Renders the events wraps into the event manager
     *
     * @param Ivory\GoogleMapBundle\Model\Events\EventManager $eventManager
     * @return string HTML output
     */
    public function render(EventManager $eventManager)
    {
        $html = array();
        
        foreach($eventManager->getDomEvents() as $domEvent)
            $html[] = $this->eventHelper->renderDomEvent($domEvent);
        
        foreach($eventManager->getDomEventsOnce() as $domEventOnce)
            $html[] = $this->eventHelper->renderDomEventOnce($domEventOnce);
        
        foreach($eventManager->getEvents() as $event)
            $html[] = $this->eventHelper->renderEvent($event);
        
        foreach($eventManager->getEventsOnce() as $eventOnce)
            $html[] = $this->eventHelper->renderEventOnce($eventOnce);
        
        return implode('', $html);
    }
}
