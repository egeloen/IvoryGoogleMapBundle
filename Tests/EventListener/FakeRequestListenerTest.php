<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\EventListener;

use Ivory\GoogleMapBundle\EventListener\FakeRequestListener;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Fake request listener test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FakeRequestListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\EventListener\FakeRequestListener */
    protected $fakeRequestListener;

    /** @var \Symfony\Component\HttpKernel\Event\GetResponseEvent */
    protected $getResponseEventMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $request->server = $this->getMock('Symfony\Component\HttpFoundation\ServerBag');

        $this->getResponseEventMock = $this->getMockBuilder('Symfony\Component\HttpKernel\Event\GetResponseEvent')
            ->disableOriginalConstructor()
            ->getMock();

        $this->getResponseEventMock
            ->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $this->fakeRequestListener = new FakeRequestListener('111.111.111.111');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->fakeRequestListener);
        unset($this->getResponseEventMock);
    }

    public function testInitialState()
    {
        $this->assertSame('111.111.111.111', $this->fakeRequestListener->getFakeIp());
    }

    public function testFakeIpWithValidValue()
    {
        $this->fakeRequestListener->setFakeIp('222.222.222.222');

        $this->assertSame('222.222.222.222', $this->fakeRequestListener->getFakeIp());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The geocoder fake IP must be a string value.
     */
    public function testFakeIpWithInvalidValue()
    {
        $this->fakeRequestListener->setFakeIp(true);
    }

    public function testOnKernelRequestWithMaster()
    {
        $this->fakeRequestListener->setFakeIp('222.222.222.222');

        $this->getResponseEventMock
            ->expects($this->once())
            ->method('getRequestType')
            ->will($this->returnValue(HttpKernelInterface::MASTER_REQUEST));

        $this->getResponseEventMock->getRequest()->server
            ->expects($this->once())
            ->method('set')
            ->with($this->equalTo('REMOTE_ADDR'), $this->equalTo('222.222.222.222'));

        $this->fakeRequestListener->onKernelRequest($this->getResponseEventMock);
    }

    public function testOnKernelRequestWithoutMasterRequest()
    {
        $this->getResponseEventMock
            ->expects($this->once())
            ->method('getRequestType')
            ->will($this->returnValue(HttpKernelInterface::SUB_REQUEST));

        $this->getResponseEventMock->getRequest()->server
            ->expects($this->never())
            ->method('set');

        $this->fakeRequestListener->onKernelRequest($this->getResponseEventMock);
    }
}
