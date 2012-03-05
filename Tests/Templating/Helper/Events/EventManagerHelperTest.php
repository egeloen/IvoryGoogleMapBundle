<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Events;

use Ivory\GoogleMapBundle\Templating\Helper\Events\EventManagerHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Events\EventHelper;

use Ivory\GoogleMapBundle\Model\Events\EventManager;
use Ivory\GoogleMapBundle\Model\Events\Event;

/**
 * Event manager helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Events\EventManagerHelper
     */
    protected static $eventManagerHelper = null;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        self::$eventManagerHelper = new EventManagerHelper(new EventHelper());
    }

    /**
     * Checks the render method
     */
    public function testRender()
    {
        $eventManagerTest = new EventManager();

        $domEventTest = new Event();
        $domEventTest->setInstance('instance');
        $domEventTest->setEventName('event_name');
        $domEventTest->setHandle('handle');
        $domEventTest->setCapture(true);
        $eventManagerTest->addDomEvent($domEventTest);

        $domEventOnceTest = new Event();
        $domEventOnceTest->setInstance('instance');
        $domEventOnceTest->setEventName('event_name');
        $domEventOnceTest->setHandle('handle');
        $domEventOnceTest->setCapture(true);
        $eventManagerTest->addDomEventOnce($domEventOnceTest);

        $eventTest = new Event();
        $eventTest->setInstance('instance');
        $eventTest->setEventName('event_name');
        $eventTest->setHandle('handle');
        $eventManagerTest->addEvent($eventTest);

        $eventOnceTest = new Event();
        $eventOnceTest->setInstance('instance');
        $eventOnceTest->setEventName('event_name');
        $eventOnceTest->setHandle('handle');
        $eventManagerTest->addEventOnce($eventOnceTest);

        $this->assertEquals(self::$eventManagerHelper->render($eventManagerTest),
            'var '.$domEventTest->getJavascriptVariable().' = google.maps.event.addDomListener(instance, "event_name", handle, true);'.PHP_EOL.
            'var '.$domEventOnceTest->getJavascriptVariable().' = google.maps.event.addDomListenerOnce(instance, "event_name", handle, true);'.PHP_EOL.
            'var '.$eventTest->getJavascriptVariable().' = google.maps.event.addListener(instance, "event_name", handle);'.PHP_EOL.
            'var '.$eventOnceTest->getJavascriptVariable().' = google.maps.event.addListenerOnce(instance, "event_name", handle);'.PHP_EOL
        );
    }
}
