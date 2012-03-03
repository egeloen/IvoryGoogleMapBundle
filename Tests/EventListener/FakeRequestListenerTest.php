<?php

namespace Ivory\GoogleMapBundle\Tests\EventListener;

use Ivory\GoogleMapBundle\EventListener\FakeRequestListener;

/**
 * FakeRequestListener test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FakeRequestListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\EventListener\FakeRequestListener $fakeRequestListene Fake request listener tested
     */
    protected static $fakeRequestListener = null;

    /**
     * @override
     */
    public function setUp()
    {
        self::$fakeRequestListener = new FakeRequestListener('111.111.111.111');
    }

    /**
     * Checks the fake IP getter & setter
     */
    public function testFakeIp()
    {
        $this->assertEquals(self::$fakeRequestListener->getFakeIp(), '111.111.111.111');
    }
}
