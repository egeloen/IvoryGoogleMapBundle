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
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RegisterControlRendererPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $controlManagerRenderer = $container->getDefinition('ivory.google_map.helper.renderer.control.manager');

        foreach ($container->findTaggedServiceIds('ivory.google_map.helper.renderer.control') as $id => $attributes) {
            $controlManagerRenderer->addMethodCall('addRenderer', [new Reference($id)]);
        }
    }
}
