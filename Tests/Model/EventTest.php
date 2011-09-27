<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Base;

use Ivory\GoogleMapBundle\Tests\Model\Assets\AbstractJavascriptVariableAssetTest;

use Ivory\GoogleMapBundle\Model\Event;

/**
 * Event test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Event Tested event
     */
    protected static $event = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$event = new Event();
    }
    
    /**
     * @override
     */
    public function testJavascriptVariable() 
    {
        $this->assertEquals(substr(self::$event->getJavascriptVariable(), 0, 6), 'event_');
    }
    
    /**
     * Checks the event default value
     */
    public function testDefaultValues()
    {
        $this->assertNull(self::$event->getInstance());
        $this->assertNull(self::$event->getEventName());
        $this->assertNull(self::$event->getHandle());
        $this->assertFalse(self::$event->isCapture());
    }
    
    /**
     * Checks the instance getter & setter
     */
    public function testInstance()
    {
        self::$event->setInstance('instance');
        $this->assertEquals(self::$event->getInstance(), 'instance');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$event->setInstance(0);
    }
    
    /**
     * Checks the event name getter & setter
     */
    public function testEventName()
    {
        self::$event->setEventName('event_name');
        $this->assertEquals(self::$event->getEventName(), 'event_name');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$event->setEventName(0);
    }
    
    /**
     * Checks the handle getter & setter
     */
    public function testHandle()
    {
        self::$event->setHandle('handle');
        $this->assertEquals(self::$event->getHandle(), 'handle');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$event->setHandle(0);
    }
    
    /**
     * Checks the capture getter & setter
     */
    public function testCapture()
    {
        self::$event->setCapture(true);
        $this->assertTrue(self::$event->isCapture());
        
        $this->setExpectedException('InvalidArgumentException');
        self::$event->setCapture('foo');
    }
}
