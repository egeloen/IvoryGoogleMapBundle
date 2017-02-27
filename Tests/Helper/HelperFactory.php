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

use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Helper\StaticMapHelper;
use Ivory\GoogleMapBundle\DependencyInjection\IvoryGoogleMapExtension;
use Ivory\GoogleMapBundle\IvoryGoogleMapBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HelperFactory
{
    /**
     * @var ContainerInterface
     */
    private static $container;

    /**
     * @return ApiHelper
     */
    public static function createApiHelper()
    {
        return self::getContainer()->get('ivory.google_map.helper.api');
    }

    /**
     * @return MapHelper
     */
    public static function createMapHelper()
    {
        return self::getContainer()->get('ivory.google_map.helper.map');
    }

    /**
     * @return StaticMapHelper
     */
    public static function createStaticMapHelper()
    {
        return self::getContainer()->get('ivory.google_map.helper.map.static');
    }

    /**
     * @return PlaceAutocompleteHelper
     */
    public static function createPlaceAutocompleteHelper()
    {
        return self::getContainer()->get('ivory.google_map.helper.place_autocomplete');
    }

    /**
     * @return ContainerInterface
     */
    private static function getContainer()
    {
        if (self::$container !== null) {
            return self::$container;
        }

        $config = [];

        if (isset($_SERVER['API_KEY'])) {
            $config['static_map']['api_key'] = $_SERVER['API_KEY'];
        }

        $container = new ContainerBuilder();
        $container->setParameter('locale', 'en');
        $container->setParameter('kernel.debug', false);

        if (!empty($config)) {
            $container->prependExtensionConfig('ivory_google_map', $config);
        }

        $container->registerExtension($extension = new IvoryGoogleMapExtension());
        $container->loadFromExtension($extension->getAlias());
        (new IvoryGoogleMapBundle())->build($container);

        $container->compile();

        return self::$container = $container;
    }
}
