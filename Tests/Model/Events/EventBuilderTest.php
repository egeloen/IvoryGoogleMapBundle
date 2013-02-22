<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Events;

use Ivory\GoogleMapBundle\Model\Events\EventBuilder;

/**
 * Event builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Events\EventBuilder */
    protected $eventBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->eventBuilder = new EventBuilder('Ivory\GoogleMap\Events\Event');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->eventBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Events\Event', $this->eventBuilder->getClass());
        $this->assertNull($this->eventBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->eventBuilder->getInstance());
        $this->assertNull($this->eventBuilder->getEventName());
        $this->assertNull($this->eventBuilder->getHandle());
        $this->assertNull($this->eventBuilder->isCapture());
    }

    public function testSingleBuildWithoutValues()
    {
        $event = $this->eventBuilder->build();

        $this->assertSame('event_', substr($event->getJavascriptVariable(), 0, 6));
        $this->assertNull($event->getInstance());
        $this->assertNull($event->getEventName());
        $this->assertNull($event->getHandle());
        $this->assertFalse($event->isCapture());
    }

    public function testSingleBuildWithValues()
    {
        $this->eventBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setInstance('instance')
            ->setEventName('event_name')
            ->setHandle('handle')
            ->setCapture(true);

        $this->assertSame('foo', $this->eventBuilder->getPrefixJavascriptVariable());
        $this->assertSame('instance', $this->eventBuilder->getInstance());
        $this->assertSame('event_name', $this->eventBuilder->getEventName());
        $this->assertSame('handle', $this->eventBuilder->getHandle());
        $this->assertTrue($this->eventBuilder->isCapture());

        $event = $this->eventBuilder->build();

        $this->assertSame('foo', substr($event->getJavascriptVariable(), 0, 3));
        $this->assertSame('instance', $event->getInstance());
        $this->assertSame('event_name', $event->getEventName());
        $this->assertSame('handle', $event->getHandle());
        $this->assertTrue($event->isCapture());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->eventBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setInstance('instance')
            ->setEventName('event_name')
            ->setHandle('handle')
            ->setCapture(true);

        $event1 = $this->eventBuilder->build();
        $event2 = $this->eventBuilder->build();

        $this->assertNotSame($event1, $event2);

        $this->assertSame('foo', substr($event1->getJavascriptVariable(), 0, 3));
        $this->assertSame('instance', $event1->getInstance());
        $this->assertSame('event_name', $event1->getEventName());
        $this->assertSame('handle', $event1->getHandle());
        $this->assertTrue($event1->isCapture());

        $this->assertSame('foo', substr($event2->getJavascriptVariable(), 0, 3));
        $this->assertSame('instance', $event2->getInstance());
        $this->assertSame('event_name', $event2->getEventName());
        $this->assertSame('handle', $event2->getHandle());
        $this->assertTrue($event2->isCapture());
    }

    public function testMultipleBuildWithReset()
    {
        $this->eventBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setInstance('instance')
            ->setEventName('event_name')
            ->setHandle('handle')
            ->setCapture(true);

        $event1 = $this->eventBuilder->build();
        $this->eventBuilder->reset();
        $event2 = $this->eventBuilder->build();

        $this->assertNotSame($event1, $event2);

        $this->assertSame('foo', substr($event1->getJavascriptVariable(), 0, 3));
        $this->assertSame('instance', $event1->getInstance());
        $this->assertSame('event_name', $event1->getEventName());
        $this->assertSame('handle', $event1->getHandle());
        $this->assertTrue($event1->isCapture());

        $this->assertSame('event_', substr($event2->getJavascriptVariable(), 0, 6));
        $this->assertNull($event2->getInstance());
        $this->assertNull($event2->getEventName());
        $this->assertNull($event2->getHandle());
        $this->assertFalse($event2->isCapture());
    }
}
