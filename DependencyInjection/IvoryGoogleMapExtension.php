<?php

namespace Ivory\GoogleMapBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Ivory google map extension
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryGoogleMapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        foreach(array('services.xml') as $file)
            $loader->load($file);

        $container->setParameter('ivory_google_map.map.class', $config['map']['class']);
        $container->setParameter('ivory_google_map.map.prefix_javascript_variable', $config['map']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.map.html_container', $config['map']['html_container']);
        $container->setParameter('ivory_google_map.map.auto_zoom', $config['map']['auto_zoom']);
        $container->setParameter('ivory_google_map.map.center.longitude', $config['map']['center']['longitude']);
        $container->setParameter('ivory_google_map.map.center.latitude', $config['map']['center']['latitude']);
        $container->setParameter('ivory_google_map.map.type', $config['map']['type']);
        $container->setParameter('ivory_google_map.map.zoom', $config['map']['zoom']);
        $container->setParameter('ivory_google_map.map.width', $config['map']['width']);
        $container->setParameter('ivory_google_map.map.height', $config['map']['height']);
        $container->setParameter('ivory_google_map.map.map_options', $config['map']['map_options']);
        $container->setParameter('ivory_google_map.map.stylesheet_options', $config['map']['stylesheet_options']);
        
        $container->setParameter('ivory_google_map.coordinate.class', $config['coordinate']['class']);
        $container->setParameter('ivory_google_map.coordinate.latitude', $config['coordinate']['latitude']);
        $container->setParameter('ivory_google_map.coordinate.longitude', $config['coordinate']['longitude']);
        $container->setParameter('ivory_google_map.coordinate.no_wrap', $config['coordinate']['no_wrap']);

        $container->setParameter('ivory_google_map.marker.class', $config['marker']['class']);
        $container->setParameter('ivory_google_map.marker.prefix_javascript_variable', $config['marker']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.marker.icon', $config['marker']['icon']);
        $container->setParameter('ivory_google_map.marker.shadow', $config['marker']['shadow']);
        $container->setParameter('ivory_google_map.marker.options', $config['marker']['options']);

        $container->setParameter('ivory_google_map.bound.class', $config['bound']['class']);
        $container->setParameter('ivory_google_map.bound.prefix_javascript_variable', $config['bound']['prefix_javascript_variable']);

        $container->setParameter('ivory_google_map.info_window.class', $config['info_window']['class']);
        $container->setParameter('ivory_google_map.info_window.prefix_javascript_variable', $config['info_window']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.info_window.content', $config['info_window']['content']);
        $container->setParameter('ivory_google_map.info_window.options', $config['info_window']['options']);
        $container->setParameter('ivory_google_map.info_window.open', $config['info_window']['open']);

        $container->setParameter('ivory_google_map.polyline.class', $config['polyline']['class']);
        $container->setParameter('ivory_google_map.polyline.prefix_javascript_variable', $config['polyline']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.polyline.options', $config['polyline']['options']);

        $container->setParameter('ivory_google_map.polygon.class', $config['polygon']['class']);
        $container->setParameter('ivory_google_map.polygon.prefix_javascript_variable', $config['polygon']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.polygon.options', $config['polygon']['options']);

        $container->setParameter('ivory_google_map.rectangle.class', $config['rectangle']['class']);
        $container->setParameter('ivory_google_map.rectangle.prefix_javascript_variable', $config['rectangle']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.rectangle.options', $config['rectangle']['options']);

        $container->setParameter('ivory_google_map.circle.class', $config['circle']['class']);
        $container->setParameter('ivory_google_map.circle.prefix_javascript_variable', $config['circle']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.circle.radius', $config['circle']['radius']);
        $container->setParameter('ivory_google_map.circle.options', $config['circle']['options']);

        $container->setParameter('ivory_google_map.ground_overlay.class', $config['ground_overlay']['class']);
        $container->setParameter('ivory_google_map.ground_overlay.prefix_javascript_variable', $config['ground_overlay']['prefix_javascript_variable']);
        $container->setParameter('ivory_google_map.ground_overlay.options', $config['ground_overlay']['options']);

        if($config['twig']['enabled'])
            $loader->load('twig.xml');
    }
}
