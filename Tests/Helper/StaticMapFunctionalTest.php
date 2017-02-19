<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Helper;

use Ivory\Tests\GoogleMap\Helper\Functional\StaticMapFunctionalTest as BaseStaticMapFunctionalTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class StaticMapFunctionalTest extends BaseStaticMapFunctionalTest
{
    /**
     * {@inheritdoc}
     */
    protected function createStaticMapHelper()
    {
        return HelperFactory::createStaticMapHelper();
    }
}
