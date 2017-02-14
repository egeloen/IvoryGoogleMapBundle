<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle;

use Ivory\GoogleMapBundle\DependencyInjection\Compiler\CleanTemplatingPass;
use Ivory\GoogleMapBundle\DependencyInjection\Compiler\RegisterControlRendererPass;
use Ivory\GoogleMapBundle\DependencyInjection\Compiler\RegisterExtendableRendererPass;
use Ivory\GoogleMapBundle\DependencyInjection\Compiler\RegisterFormResourcePass;
use Ivory\GoogleMapBundle\DependencyInjection\Compiler\RegisterHelperListenerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new CleanTemplatingPass())
            ->addCompilerPass(new RegisterControlRendererPass())
            ->addCompilerPass(new RegisterExtendableRendererPass())
            ->addCompilerPass(new RegisterFormResourcePass())
            ->addCompilerPass(new RegisterHelperListenerPass());
    }
}
