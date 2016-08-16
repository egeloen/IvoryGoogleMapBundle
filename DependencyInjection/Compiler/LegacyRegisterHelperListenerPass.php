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

use Symfony\Component\HttpKernel\DependencyInjection\RegisterListenersPass;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LegacyRegisterHelperListenerPass extends RegisterListenersPass
{
    public function __construct()
    {
        parent::__construct(
            'ivory.google_map.helper.event_dispatcher',
            'ivory.google_map.helper.listener',
            'ivory.google_map.helper.subscriber'
        );
    }
}
