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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RegisterFormResourcePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasParameter($parameter = 'templating.helper.form.resources')) {
            $container->setParameter(
                $parameter,
                array_merge(
                    ['IvoryGoogleMapBundle:Form'],
                    $container->getParameter($parameter)
                )
            );
        }

        if ($container->hasParameter($parameter = 'twig.form.resources')) {
            $container->setParameter(
                $parameter,
                array_merge(
                    ['@IvoryGoogleMap/Form/place_autocomplete_widget.html.twig'],
                    $container->getParameter($parameter)
                )
            );
        }
    }
}
