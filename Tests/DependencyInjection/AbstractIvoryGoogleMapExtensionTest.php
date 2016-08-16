<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Service\Directions\Directions;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrix;
use Ivory\GoogleMap\Service\Geocoder\GeocoderProvider;
use Ivory\GoogleMap\Service\TimeZone\TimeZone;
use Ivory\GoogleMapBundle\DependencyInjection\IvoryGoogleMapExtension;
use Ivory\GoogleMapBundle\IvoryGoogleMapBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractIvoryGoogleMapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var bool
     */
    private $debug;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var HttpClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private $client;

    /**
     * @var MessageFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $messageFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.debug', $this->debug = false);
        $this->container->setParameter('locale', $this->locale = 'en');
        $this->container->set('httplug.client', $this->client = $this->createClientMock());
        $this->container->set('httplug.message_factory', $this->messageFactory = $this->createMessageFactoryMock());
        $this->container->registerExtension($extension = new IvoryGoogleMapExtension());
        $this->container->loadFromExtension($extension->getAlias());
        (new IvoryGoogleMapBundle())->build($this->container);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $configuration
     */
    abstract protected function loadConfiguration(ContainerBuilder $container, $configuration);

    public function testDefaultState()
    {
        $this->container->compile();

        $apiHelper = $this->container->get('ivory.google_map.helper.api');
        $mapHelper = $this->container->get('ivory.google_map.helper.map');
        $placeAutocompleteHelper = $this->container->get('ivory.google_map.helper.place_autocomplete');

        $this->assertInstanceOf(ApiHelper::class, $apiHelper);
        $this->assertInstanceOf(MapHelper::class, $mapHelper);
        $this->assertInstanceOf(PlaceAutocompleteHelper::class, $placeAutocompleteHelper);

        $formatter = $this->container->get('ivory.google_map.helper.formatter');
        $loaderRenderer = $this->container->get('ivory.google_map.helper.renderer.loader');;

        $this->assertSame($this->debug, $formatter->isDebug());
        $this->assertSame($this->locale, $loaderRenderer->getLanguage());
        $this->assertFalse($loaderRenderer->hasKey());

        $this->assertTrue($this->container->get('ivory.google_map.helper.renderer.control.manager')->hasRenderers());
        $this->assertTrue($this->container->get('ivory.google_map.helper.renderer.overlay.extendable')->hasRenderers());
        $this->assertTrue($this->container->get('ivory.google_map.helper.event_dispatcher')->hasListeners());

        $this->assertFalse($this->container->has('ivory.google_map.directions'));
        $this->assertFalse($this->container->has('ivory.google_map.distance_matrix'));
        $this->assertFalse($this->container->has('ivory.google_map.geocoder'));
        $this->assertFalse($this->container->has('ivory.google_map.time_zone'));

        $this->assertFalse($this->container->has('ivory.google_map.templating.api'));
        $this->assertFalse($this->container->has('ivory.google_map.templating.map'));
        $this->assertFalse($this->container->has('ivory.google_map.templating.place_autocomplete'));

        $this->assertFalse($this->container->has('ivory.google_map.twig.extension.api'));
        $this->assertFalse($this->container->has('ivory.google_map.twig.extension.map'));
        $this->assertFalse($this->container->has('ivory.google_map.twig.extension.place_autocomplete'));
    }

    public function testTemplatingHelpers()
    {
        $this->container->setDefinition('templating.engine.php', new Definition(\stdClass::class));
        $this->container->compile();

        $this->assertTrue($this->container->has('ivory.google_map.templating.api'));
        $this->assertTrue($this->container->has('ivory.google_map.templating.map'));
        $this->assertTrue($this->container->has('ivory.google_map.templating.place_autocomplete'));
    }

    public function testTwigExtensions()
    {
        $this->container->setDefinition('twig', new Definition(\stdClass::class));
        $this->container->compile();

        $this->assertTrue($this->container->has('ivory.google_map.twig.extension.api'));
        $this->assertTrue($this->container->has('ivory.google_map.twig.extension.map'));
        $this->assertTrue($this->container->has('ivory.google_map.twig.extension.place_autocomplete'));
    }

    public function testTemplatingFormResources()
    {
        $this->container->setParameter($parameter = 'templating.helper.form.resources', $resources = ['resource']);
        $this->container->compile();

        $this->assertSame(
            array_merge(['IvoryGoogleMapBundle:Form'], $resources),
            $this->container->getParameter($parameter)
        );
    }

    public function testTwigFormResources()
    {
        $this->container->setParameter($parameter = 'twig.form.resources', $resources = ['resource']);
        $this->container->compile();

        $this->assertSame(
            array_merge(['IvoryGoogleMapBundle:Form:place_autocomplete_widget.html.twig'], $resources),
            $this->container->getParameter($parameter)
        );
    }

    public function testFormatterDebug()
    {
        $this->loadConfiguration($this->container, 'debug');
        $this->container->compile();

        $this->assertTrue($this->container->get('ivory.google_map.helper.formatter')->isDebug());
    }

    public function testMapLanguage()
    {
        $this->loadConfiguration($this->container, 'language');
        $this->container->compile();

        $this->assertSame('fr', $this->container->get('ivory.google_map.helper.renderer.loader')->getLanguage());
    }

    public function testMapApiKey()
    {
        $this->loadConfiguration($this->container, 'api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.helper.renderer.loader')->getKey());
    }

    public function testDirections()
    {
        $this->loadConfiguration($this->container, 'directions');
        $this->container->compile();

        $directions = $this->container->get('ivory.google_map.directions');

        $this->assertInstanceOf(Directions::class, $directions);
        $this->assertSame($this->client, $directions->getClient());
        $this->assertSame($this->messageFactory, $directions->getMessageFactory());
        $this->assertTrue($directions->isHttps());
        $this->assertSame(Directions::FORMAT_JSON, $directions->getFormat());
        $this->assertFalse($directions->hasBusinessAccount());
    }

    public function testDirectionsHttps()
    {
        $this->loadConfiguration($this->container, 'directions_https');
        $this->container->compile();

        $this->assertFalse($this->container->get('ivory.google_map.directions')->isHttps());
    }

    public function testDirectionsFormat()
    {
        $this->loadConfiguration($this->container, 'directions_format');
        $this->container->compile();

        $this->assertSame(Directions::FORMAT_XML, $this->container->get('ivory.google_map.directions')->getFormat());
    }

    public function testDirectionsApiKey()
    {
        $this->loadConfiguration($this->container, 'directions_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.directions')->getKey());
    }

    public function testDirectionsBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'directions_business_account');
        $this->container->compile();

        $directions = $this->container->get('ivory.google_map.directions');

        $this->assertTrue($directions->hasBusinessAccount());
        $this->assertSame('my-client', $directions->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $directions->getBusinessAccount()->getSecret());
        $this->assertFalse($directions->getBusinessAccount()->hasChannel());
    }

    public function testDirectionsBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'directions_business_account_channel');
        $this->container->compile();

        $directions = $this->container->get('ivory.google_map.directions');

        $this->assertTrue($directions->hasBusinessAccount());
        $this->assertSame('my-client', $directions->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $directions->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $directions->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDirectionsBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'directions_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDirectionsInvalid()
    {
        $this->loadConfiguration($this->container, 'directions_invalid');
        $this->container->compile();
    }

    public function testDistanceMatrix()
    {
        $this->loadConfiguration($this->container, 'distance_matrix');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory.google_map.distance_matrix');

        $this->assertInstanceOf(DistanceMatrix::class, $distanceMatrix);
        $this->assertSame($this->client, $distanceMatrix->getClient());
        $this->assertSame($this->messageFactory, $distanceMatrix->getMessageFactory());
        $this->assertTrue($distanceMatrix->isHttps());
        $this->assertSame(DistanceMatrix::FORMAT_JSON, $distanceMatrix->getFormat());
        $this->assertFalse($distanceMatrix->hasBusinessAccount());
    }

    public function testDistanceMatrixHttps()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_https');
        $this->container->compile();

        $this->assertFalse($this->container->get('ivory.google_map.distance_matrix')->isHttps());
    }

    public function testDistanceMatrixFormat()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_format');
        $this->container->compile();

        $this->assertSame(
            DistanceMatrix::FORMAT_XML,
            $this->container->get('ivory.google_map.distance_matrix')->getFormat()
        );
    }

    public function testDistanceMatrixApiKey()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.distance_matrix')->getKey());
    }

    public function testDistanceMatrixBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_business_account');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory.google_map.distance_matrix');

        $this->assertTrue($distanceMatrix->hasBusinessAccount());
        $this->assertSame('my-client', $distanceMatrix->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $distanceMatrix->getBusinessAccount()->getSecret());
        $this->assertFalse($distanceMatrix->getBusinessAccount()->hasChannel());
    }

    public function testDistanceMatrixBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_business_account_channel');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory.google_map.distance_matrix');

        $this->assertTrue($distanceMatrix->hasBusinessAccount());
        $this->assertSame('my-client', $distanceMatrix->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $distanceMatrix->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $distanceMatrix->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDistanceMatrixBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDistanceMatrixInvalid()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_invalid');
        $this->container->compile();
    }

    public function testGeocoder()
    {
        $this->loadConfiguration($this->container, 'geocoder');
        $this->container->compile();

        $geocoder = $this->container->get('ivory.google_map.geocoder');

        $this->assertInstanceOf(GeocoderProvider::class, $geocoder);
        $this->assertSame($this->client, $geocoder->getClient());
        $this->assertSame($this->messageFactory, $geocoder->getMessageFactory());
        $this->assertTrue($geocoder->isHttps());
        $this->assertSame(GeocoderProvider::FORMAT_JSON, $geocoder->getFormat());
        $this->assertFalse($geocoder->hasBusinessAccount());
    }

    public function testGeocoderHttps()
    {
        $this->loadConfiguration($this->container, 'geocoder_https');
        $this->container->compile();

        $this->assertFalse($this->container->get('ivory.google_map.geocoder')->isHttps());
    }

    public function testGeocoderFormat()
    {
        $this->loadConfiguration($this->container, 'geocoder_format');
        $this->container->compile();

        $this->assertSame(
            GeocoderProvider::FORMAT_XML,
            $this->container->get('ivory.google_map.geocoder')->getFormat()
        );
    }

    public function testGeocoderApiKey()
    {
        $this->loadConfiguration($this->container, 'geocoder_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.geocoder')->getKey());
    }

    public function testGeocoderBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'geocoder_business_account');
        $this->container->compile();

        $geocoder = $this->container->get('ivory.google_map.geocoder');

        $this->assertTrue($geocoder->hasBusinessAccount());
        $this->assertSame('my-client', $geocoder->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $geocoder->getBusinessAccount()->getSecret());
        $this->assertFalse($geocoder->getBusinessAccount()->hasChannel());
    }

    public function testGeocoderBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'geocoder_business_account_channel');
        $this->container->compile();

        $geocoder = $this->container->get('ivory.google_map.geocoder');

        $this->assertTrue($geocoder->hasBusinessAccount());
        $this->assertSame('my-client', $geocoder->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $geocoder->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $geocoder->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testGeocoderBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'geocoder_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testGeocoderInvalid()
    {
        $this->loadConfiguration($this->container, 'geocoder_invalid');
        $this->container->compile();
    }

    public function testTimeZone()
    {
        $this->loadConfiguration($this->container, 'time_zone');
        $this->container->compile();

        $timeZone = $this->container->get('ivory.google_map.time_zone');

        $this->assertInstanceOf(TimeZone::class, $timeZone);
        $this->assertSame($this->client, $timeZone->getClient());
        $this->assertSame($this->messageFactory, $timeZone->getMessageFactory());
        $this->assertTrue($timeZone->isHttps());
        $this->assertSame(TimeZone::FORMAT_JSON, $timeZone->getFormat());
        $this->assertFalse($timeZone->hasBusinessAccount());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The http scheme is not supported.
     */
    public function testTimeZoneHttps()
    {
        $this->loadConfiguration($this->container, 'time_zone_https');
        $this->container->compile();

        $this->container->get('ivory.google_map.time_zone');
    }

    public function testTimeZoneFormat()
    {
        $this->loadConfiguration($this->container, 'time_zone_format');
        $this->container->compile();

        $this->assertSame(TimeZone::FORMAT_XML, $this->container->get('ivory.google_map.time_zone')->getFormat());
    }

    public function testTimeZoneApiKey()
    {
        $this->loadConfiguration($this->container, 'time_zone_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.time_zone')->getKey());
    }

    public function testTimeZoneBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'time_zone_business_account');
        $this->container->compile();

        $timeZone = $this->container->get('ivory.google_map.time_zone');

        $this->assertTrue($timeZone->hasBusinessAccount());
        $this->assertSame('my-client', $timeZone->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $timeZone->getBusinessAccount()->getSecret());
        $this->assertFalse($timeZone->getBusinessAccount()->hasChannel());
    }

    public function testTimeZoneBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'time_zone_business_account_channel');
        $this->container->compile();

        $timeZone = $this->container->get('ivory.google_map.time_zone');

        $this->assertTrue($timeZone->hasBusinessAccount());
        $this->assertSame('my-client', $timeZone->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $timeZone->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $timeZone->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testTimeZoneBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'time_zone_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testTimeZoneInvalid()
    {
        $this->loadConfiguration($this->container, 'time_zone_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage No "class" attribute found for the tag "ivory.google_map.helper.renderer.extendable" on the service "acme.map.helper.renderer.extendable".
     */
    public function testMissingExtendableRendererClassTagAttribute()
    {
        $this->loadConfiguration($this->container, 'extendable');
        $this->container->compile();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|HttpClient
     */
    private function createClientMock()
    {
        return $this->createMock(HttpClient::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|MessageFactory
     */
    private function createMessageFactoryMock()
    {
        return $this->createMock(MessageFactory::class);
    }
}
