<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RegisterHelperListenerPass implements CompilerPassInterface
{
    /**
     * @var RegisterListenersPass[]
     */
    private $passes = [];

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        foreach (['api', 'map', 'map.static', 'place_autocomplete'] as $helper) {
            $this->passes[] = new RegisterListenersPass(
                'ivory.google_map.helper.'.$helper.'.event_dispatcher',
                'ivory.google_map.helper.'.$helper.'.listener',
                'ivory.google_map.helper.'.$helper.'.subscriber'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($this->passes as $pass) {
            $pass->process($container);
        }
    }
}
