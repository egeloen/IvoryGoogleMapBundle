<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests;

use Ivory\GoogleMapBundle\IvoryGoogleMapBundle;

/**
 * Ivory Google Map bundle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBundle()
    {
        $this->assertInstanceOf('Symfony\Component\HttpKernel\Bundle\Bundle', new IvoryGoogleMapBundle());
    }
}
