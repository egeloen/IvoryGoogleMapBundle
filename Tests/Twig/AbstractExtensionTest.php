<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Twig;

use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractExtensionTest extends TestCase
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem([]));
        $this->twig->addExtension($this->createExtension());
    }

    /**
     * @return \Twig_Extension
     */
    abstract protected function createExtension();

    /**
     * @return \Twig_Environment
     */
    protected function getTwig()
    {
        return $this->twig;
    }
}
