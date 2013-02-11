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

/**
 * Fake request listener test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class FakeRequestListenerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\EventListener\FakeRequestListener */
    protected $fakeRequestListener;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->fakeRequestListener = new FakeRequestListener('111.111.111.111');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->fakeRequestListener);
    }

    public function testInitialState()
    {
        $this->assertSame('111.111.111.111', $this->fakeRequestListener->getFakeIp());
    }

    public function testFakeIp()
    {
        $this->fakeRequestListener->setFakeIp('222.222.222.222');

        $this->assertSame('222.222.222.222', $this->fakeRequestListener->getFakeIp());
    }
}
