<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Events;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Event service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventServiceTest extends WebTestCase
{
    /**
     * Checks the event service without configuration
     */
    public function testEventServiceWithoutConfiguration()
    {
        $event = self::createContainer()->get('ivory_google_map.event');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Events\Event', $event);
        $this->assertEquals(substr($event->getJavascriptVariable(), 0, 6), 'event_');
    }

    /**
     * Checks the event service with configuration
     */
    public function testEventServiceWithConfiguration()
    {
        $event = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.event');

        $this->assertEquals(substr($event->getJavascriptVariable(), 0, 1), 'e');
    }
}
