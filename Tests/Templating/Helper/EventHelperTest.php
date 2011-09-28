<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\EventHelper;
use Ivory\GoogleMapBundle\Model\Event;

/**
 * Event helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\EventHelper
     */
    protected static $eventHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$eventHelper = new EventHelper();
    }
    
    /**
     * Checks the render dom event method
     */
    public function testRenderDomEvent()
    {
        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        $eventTest->setCapture(true);
        
        $this->assertEquals(self::$eventHelper->renderDomEvent($eventTest), 'var '.$eventTest->getJavascriptVariable().' = google.maps.event.addDomListener(instance, "event_name", handle, true);'.PHP_EOL);
    }
    
    /**
     * Checks the render dom event once method
     */
    public function testRenderDomEventOnce()
    {
        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        $eventTest->setCapture(true);
        
        $this->assertEquals(self::$eventHelper->renderDomEventOnce($eventTest), 'var '.$eventTest->getJavascriptVariable().' = google.maps.event.addDomListenerOnce(instance, "event_name", handle, true);'.PHP_EOL);
    }
    
    /**
     * Checks the render event method
     */
    public function testRenderEvent()
    {
        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        
        $this->assertEquals(self::$eventHelper->renderEvent($eventTest), 'var '.$eventTest->getJavascriptVariable().' = google.maps.event.addListener(instance, "event_name", handle);'.PHP_EOL);
    }
    
    /**
     * Checks the render event once method
     */
    public function testRenderEventOnce()
    {
        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        
        $this->assertEquals(self::$eventHelper->renderEventOnce($eventTest), 'var '.$eventTest->getJavascriptVariable().' = google.maps.event.addListenerOnce(instance, "event_name", handle);'.PHP_EOL);
    }
}
