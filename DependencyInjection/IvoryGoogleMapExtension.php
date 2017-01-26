<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Ivory\GoogleMap\Service\BusinessAccount;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('form.xml');
        $loader->load('helper/collector.xml');
        $loader->load('helper/helper.xml');
        $loader->load('helper/renderer.xml');
        $loader->load('helper/subscriber.xml');
        $loader->load('helper/utility.xml');
        $loader->load('templating.xml');
        $loader->load('twig.xml');

        $this->loadConfig($config, $container);
        $this->loadServices($config, $container, $loader);
    }

    /**
     * @param mixed[]          $config
     * @param ContainerBuilder $container
     */
    private function loadConfig(array $config, ContainerBuilder $container)
    {
        $container
            ->getDefinition('ivory.google_map.helper.renderer.loader')
            ->addArgument($config['language']);

        if ($config['debug']) {
            $container
                ->getDefinition('ivory.google_map.helper.formatter')
                ->addArgument($config['debug']);
        }

        if (isset($config['api_key'])) {
            $container
                ->getDefinition('ivory.google_map.helper.renderer.loader')
                ->addArgument($config['api_key']);
        }
    }

    /**
     * @param mixed[]          $config
     * @param ContainerBuilder $container
     * @param LoaderInterface  $loader
     */
    private function loadServices(array $config, ContainerBuilder $container, LoaderInterface $loader)
    {
        foreach (['direction', 'distance_matrix', 'elevation', 'geocoder', 'time_zone'] as $service) {
            if (isset($config[$service]) && !empty($config[$service])) {
                $this->loadService($service, $config[$service], $container, $loader);
            }
        }
    }

    /**
     * @param string           $service
     * @param mixed[]          $config
     * @param ContainerBuilder $container
     * @param LoaderInterface  $loader
     */
    private function loadService($service, array $config, ContainerBuilder $container, LoaderInterface $loader)
    {
        $loader->load('service/'.$service.'.xml');
        $loader->load('service/utility.xml');

        $definition = $container
            ->getDefinition($serviceName = 'ivory.google_map.'.$service)
            ->addArgument(new Reference($config['client']))
            ->addArgument(new Reference($config['message_factory']))
            ->addArgument(new Reference('ivory.google_map.utility.parser'));

        if (isset($config['https'])) {
            $definition->addMethodCall('setHttps', [$config['https']]);
        }

        if (isset($config['format'])) {
            $definition->addMethodCall('setFormat', [$config['format']]);
        }

        if (isset($config['api_key'])) {
            $definition->addMethodCall('setKey', [$config['api_key']]);
        }

        if (isset($config['business_account'])) {
            $businessAccountConfig = $config['business_account'];

            $container->setDefinition(
                $businessAccountName = $serviceName.'.business_account',
                new Definition(BusinessAccount::class, [
                    $businessAccountConfig['client_id'],
                    $businessAccountConfig['secret'],
                    isset($businessAccountConfig['channel']) ? $businessAccountConfig['channel'] : null,
                ])
            );

            $definition->addMethodCall('setBusinessAccount', [new Reference($businessAccountName)]);
        }
    }
}
