<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Helper\Place\Event;

use Ivory\GoogleMapBundle\Tests\Helper\HelperFactory;
use Ivory\Tests\GoogleMap\Helper\Functional\Place\Event\AutocompleteDomEventFunctionalTest as BaseAutocompleteDomEventFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class AutocompleteDomEventFunctionalTest extends BaseAutocompleteDomEventFunctionalTest
{
    /**
     * {@inheritdoc}
     */
    protected function createApiHelper()
    {
        return HelperFactory::createApiHelper();
    }

    /**
     * {@inheritdoc}
     */
    protected function createPlaceAutocompleteHelper()
    {
        return HelperFactory::createPlaceAutocompleteHelper();
    }
}
