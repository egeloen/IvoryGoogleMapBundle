<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\EventListener;

use InvalidArgumentException;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Fake request listener.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FakeRequestListener
{
    /** @var string */
    protected $fakeIp;

    /**
     * Creates a fake IP request
     *
     * @param string $fakeIp The fake IP.
     */
    public function __construct($fakeIp)
    {
        $this->setFakeIp($fakeIp);
    }

    /**
     * Gets the fake IP.
     *
     * @return string The fake IP.
     */
    public function getFakeIp()
    {
        return $this->fakeIp;
    }

    /**
     * Sets the fake IP.
     *
     * @param string $fakeIp The fake IP.
     *
     * @throws \InvalidArgumentException If the fake IP is not valid.
     */
    public function setFakeIp($fakeIp)
    {
        if (!is_string($fakeIp)) {
            throw new InvalidArgumentException('The geocoder fake IP must be a string value.');
        }

        $this->fakeIp = $fakeIp;
    }

    /**
     * Action performed on kernel response event.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event The response event.
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        $event->getRequest()->server->set('REMOTE_ADDR', $this->fakeIp);
    }
}
