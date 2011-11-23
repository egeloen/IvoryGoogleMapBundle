<?php

namespace Ivory\GoogleMapBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Fake Request Listener
 * 
 * @author GeLo <geloen.eric@gmail.com>
 */
class FakeRequestListener
{
    /**
     * @var string $fakeIp
     */
    protected $fakeIp = null;

    /**
     * Creates a fake IP request
     *
     * @param string $fakeIp 
     */
    public function __construct($fakeIp)
    {
        $this->setFakeIp($fakeIp);
    }
    
    /**
     * Gets the fake IP
     *
     * @return string
     */
    public function getFakeIp()
    {
        return $this->fakeIp;
    }
    
    /**
     * Sets the fake IP
     *
     * @param string $fakeIp 
     */
    public function setFakeIp($fakeIp)
    {
        if(is_string($fakeIp))
            $this->fakeIp = $fakeIp;
        else
            throw new \InvalidArgumentException('The geocoder fake IP must be a string value.');
    }

    /**
     *
     * @param GetResponseEvent $event
     * @return type 
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if(HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType())
            return;

        if(!is_null($this->fakeIp) && !empty($this->fakeIp))
            $event->getRequest()->server->set('REMOTE_ADDR', $this->fakeIp);
    }
}
