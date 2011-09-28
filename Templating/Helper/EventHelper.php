<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\Event;

/**
 * Event helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventHelper
{   
    /**
     * Renders the javascript dom event
     *
     * @param Ivory\GoogleMapBundle\Model\Event $domEvent
     * @return string HTML output 
     */
    public function renderDomEvent(Event $domEvent)
    {
        return sprintf('var %s = google.maps.event.addDomListener(%s, "%s", %s, %s);'.PHP_EOL,
            $domEvent->getJavascriptVariable(),
            $domEvent->getInstance(),
            $domEvent->getEventName(),
            $domEvent->getHandle(),
            json_encode($domEvent->isCapture())
        );
    }
    
    /**
     * Renders the javascript dom event once
     *
     * @param Ivory\GoogleMapBundle\Model\Event $domEventOnce
     * @return string HTML output 
     */
    public function renderDomEventOnce(Event $domEventOnce)
    {
        return sprintf('var %s = google.maps.event.addDomListenerOnce(%s, "%s", %s, %s);'.PHP_EOL,
            $domEventOnce->getJavascriptVariable(),
            $domEventOnce->getInstance(),
            $domEventOnce->getEventName(),
            $domEventOnce->getHandle(),
            json_encode($domEventOnce->isCapture())
        );
    }
    
    /**
     * Renders the javascript event
     *
     * @param Ivory\GoogleMapBundle\Model\Event $event
     * @return string HTML output 
     */
    public function renderEvent(Event $event)
    {
        return sprintf('var %s = google.maps.event.addListener(%s, "%s", %s);'.PHP_EOL,
            $event->getJavascriptVariable(),
            $event->getInstance(),
            $event->getEventName(),
            $event->getHandle()
        );
    }
    
    /**
     * Renders the javascript event once
     *
     * @param Ivory\GoogleMapBundle\Model\Event $eventOnce
     * @return string HTML output 
     */
    public function renderEventOnce(Event $eventOnce)
    {
        return sprintf('var %s = google.maps.event.addListenerOnce(%s, "%s", %s);'.PHP_EOL,
            $eventOnce->getJavascriptVariable(),
            $eventOnce->getInstance(),
            $eventOnce->getEventName(),
            $eventOnce->getHandle()
        );
    }
}
