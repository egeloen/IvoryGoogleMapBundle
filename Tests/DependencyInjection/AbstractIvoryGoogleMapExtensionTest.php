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
use Ivory\GoogleMap\Service\Direction\DirectionService;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixService;
use Ivory\GoogleMap\Service\Elevation\ElevationService;
use Ivory\GoogleMap\Service\Geocoder\GeocoderService;
use Ivory\GoogleMap\Service\Place\Autocomplete\PlaceAutocompleteService;
use Ivory\GoogleMap\Service\Place\Detail\PlaceDetailService;
use Ivory\GoogleMap\Service\Place\Photo\PlacePhotoService;
use Ivory\GoogleMap\Service\Place\Search\PlaceSearchService;
use Ivory\GoogleMap\Service\TimeZone\TimeZoneService;
use Ivory\GoogleMapBundle\DependencyInjection\IvoryGoogleMapExtension;
use Ivory\GoogleMapBundle\IvoryGoogleMapBundle;
use Ivory\Serializer\SerializerInterface;
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
     * @var SerializerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.root_dir', __DIR__.'/..');
        $this->container->setParameter('kernel.debug', $this->debug = false);
        $this->container->setParameter('locale', $this->locale = 'en');
        $this->container->set('httplug.client', $this->client = $this->createClientMock());
        $this->container->set('httplug.message_factory', $this->messageFactory = $this->createMessageFactoryMock());
        $this->container->set('ivory.serializer', $this->serializer = $this->createSerializerMock());
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
        $loaderRenderer = $this->container->get('ivory.google_map.helper.renderer.loader');

        $this->assertSame($this->debug, $formatter->isDebug());
        $this->assertSame($this->locale, $loaderRenderer->getLanguage());
        $this->assertFalse($loaderRenderer->hasKey());

        $this->assertTrue($this->container->get('ivory.google_map.helper.renderer.control.manager')->hasRenderers());
        $this->assertTrue($this->container->get('ivory.google_map.helper.renderer.overlay.extendable')->hasRenderers());
        $this->assertTrue($this->container->get('ivory.google_map.helper.event_dispatcher')->hasListeners());

        $this->assertFalse($this->container->has('ivory.google_map.direction'));
        $this->assertFalse($this->container->has('ivory.google_map.distance_matrix'));
        $this->assertFalse($this->container->has('ivory.google_map.elevation'));
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

    public function testDirection()
    {
        $this->loadConfiguration($this->container, 'direction');
        $this->container->compile();

        $direction = $this->container->get('ivory.google_map.direction');

        $this->assertInstanceOf(DirectionService::class, $direction);
        $this->assertSame($this->client, $direction->getClient());
        $this->assertSame($this->messageFactory, $direction->getMessageFactory());
        $this->assertSame($this->serializer, $direction->getSerializer());
        $this->assertSame(DirectionService::FORMAT_JSON, $direction->getFormat());
        $this->assertFalse($direction->hasBusinessAccount());
    }

    public function testDirectionFormat()
    {
        $this->loadConfiguration($this->container, 'direction_format');
        $this->container->compile();

        $this->assertSame(DirectionService::FORMAT_XML, $this->container->get('ivory.google_map.direction')->getFormat());
    }

    public function testDirectionApiKey()
    {
        $this->loadConfiguration($this->container, 'direction_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.direction')->getKey());
    }

    public function testDirectionBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'direction_business_account');
        $this->container->compile();

        $direction = $this->container->get('ivory.google_map.direction');

        $this->assertTrue($direction->hasBusinessAccount());
        $this->assertSame('my-client', $direction->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $direction->getBusinessAccount()->getSecret());
        $this->assertFalse($direction->getBusinessAccount()->hasChannel());
    }

    public function testDirectionBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'direction_business_account_channel');
        $this->container->compile();

        $direction = $this->container->get('ivory.google_map.direction');

        $this->assertTrue($direction->hasBusinessAccount());
        $this->assertSame('my-client', $direction->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $direction->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $direction->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDirectionBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'direction_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testDirectionInvalid()
    {
        $this->loadConfiguration($this->container, 'direction_invalid');
        $this->container->compile();
    }

    public function testDistanceMatrix()
    {
        $this->loadConfiguration($this->container, 'distance_matrix');
        $this->container->compile();

        $distanceMatrix = $this->container->get('ivory.google_map.distance_matrix');

        $this->assertInstanceOf(DistanceMatrixService::class, $distanceMatrix);
        $this->assertSame($this->client, $distanceMatrix->getClient());
        $this->assertSame($this->messageFactory, $distanceMatrix->getMessageFactory());
        $this->assertSame($this->serializer, $distanceMatrix->getSerializer());
        $this->assertSame(DistanceMatrixService::FORMAT_JSON, $distanceMatrix->getFormat());
        $this->assertFalse($distanceMatrix->hasBusinessAccount());
    }

    public function testDistanceMatrixFormat()
    {
        $this->loadConfiguration($this->container, 'distance_matrix_format');
        $this->container->compile();

        $this->assertSame(
            DistanceMatrixService::FORMAT_XML,
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

    public function testElevation()
    {
        $this->loadConfiguration($this->container, 'elevation');
        $this->container->compile();

        $elevation = $this->container->get('ivory.google_map.elevation');

        $this->assertInstanceOf(ElevationService::class, $elevation);
        $this->assertSame($this->client, $elevation->getClient());
        $this->assertSame($this->messageFactory, $elevation->getMessageFactory());
        $this->assertSame($this->serializer, $elevation->getSerializer());
        $this->assertSame(ElevationService::FORMAT_JSON, $elevation->getFormat());
        $this->assertFalse($elevation->hasBusinessAccount());
    }

    public function testElevationFormat()
    {
        $this->loadConfiguration($this->container, 'elevation_format');
        $this->container->compile();

        $this->assertSame(ElevationService::FORMAT_XML, $this->container->get('ivory.google_map.elevation')->getFormat());
    }

    public function testElevationApiKey()
    {
        $this->loadConfiguration($this->container, 'elevation_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.elevation')->getKey());
    }

    public function testElevationBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'elevation_business_account');
        $this->container->compile();

        $elevation = $this->container->get('ivory.google_map.elevation');

        $this->assertTrue($elevation->hasBusinessAccount());
        $this->assertSame('my-client', $elevation->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $elevation->getBusinessAccount()->getSecret());
        $this->assertFalse($elevation->getBusinessAccount()->hasChannel());
    }

    public function testElevationBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'elevation_business_account_channel');
        $this->container->compile();

        $elevation = $this->container->get('ivory.google_map.elevation');

        $this->assertTrue($elevation->hasBusinessAccount());
        $this->assertSame('my-client', $elevation->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $elevation->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $elevation->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testElevationBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'elevation_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testElevationInvalid()
    {
        $this->loadConfiguration($this->container, 'elevation_invalid');
        $this->container->compile();
    }

    public function testGeocoder()
    {
        $this->loadConfiguration($this->container, 'geocoder');
        $this->container->compile();

        $geocoder = $this->container->get('ivory.google_map.geocoder');

        $this->assertInstanceOf(GeocoderService::class, $geocoder);
        $this->assertSame($this->client, $geocoder->getClient());
        $this->assertSame($this->messageFactory, $geocoder->getMessageFactory());
        $this->assertSame($this->serializer, $geocoder->getSerializer());
        $this->assertSame(GeocoderService::FORMAT_JSON, $geocoder->getFormat());
        $this->assertFalse($geocoder->hasBusinessAccount());
    }

    public function testGeocoderFormat()
    {
        $this->loadConfiguration($this->container, 'geocoder_format');
        $this->container->compile();

        $this->assertSame(
            GeocoderService::FORMAT_XML,
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

    public function testPlaceAutocomplete()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete');
        $this->container->compile();

        $placeAutocomplete = $this->container->get('ivory.google_map.place_autocomplete');

        $this->assertInstanceOf(PlaceAutocompleteService::class, $placeAutocomplete);
        $this->assertSame($this->client, $placeAutocomplete->getClient());
        $this->assertSame($this->messageFactory, $placeAutocomplete->getMessageFactory());
        $this->assertSame($this->serializer, $placeAutocomplete->getSerializer());
        $this->assertSame(PlaceAutocompleteService::FORMAT_JSON, $placeAutocomplete->getFormat());
        $this->assertFalse($placeAutocomplete->hasBusinessAccount());
    }

    public function testPlaceAutocompleteFormat()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_format');
        $this->container->compile();

        $this->assertSame(
            PlaceAutocompleteService::FORMAT_XML,
            $this->container->get('ivory.google_map.place_autocomplete')->getFormat()
        );
    }

    public function testPlaceAutocompleteApiKey()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.place_autocomplete')->getKey());
    }

    public function testPlaceAutocompleteBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_business_account');
        $this->container->compile();

        $placeAutocomplete = $this->container->get('ivory.google_map.place_autocomplete');

        $this->assertTrue($placeAutocomplete->hasBusinessAccount());
        $this->assertSame('my-client', $placeAutocomplete->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeAutocomplete->getBusinessAccount()->getSecret());
        $this->assertFalse($placeAutocomplete->getBusinessAccount()->hasChannel());
    }

    public function testPlaceAutocompleteBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_business_account_channel');
        $this->container->compile();

        $placeAutocomplete = $this->container->get('ivory.google_map.place_autocomplete');

        $this->assertTrue($placeAutocomplete->hasBusinessAccount());
        $this->assertSame('my-client', $placeAutocomplete->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeAutocomplete->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $placeAutocomplete->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceAutocompleteBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceAutocompleteInvalid()
    {
        $this->loadConfiguration($this->container, 'place_autocomplete_invalid');
        $this->container->compile();
    }

    public function testPlaceDetail()
    {
        $this->loadConfiguration($this->container, 'place_detail');
        $this->container->compile();

        $placeDetail = $this->container->get('ivory.google_map.place_detail');

        $this->assertInstanceOf(PlaceDetailService::class, $placeDetail);
        $this->assertSame($this->client, $placeDetail->getClient());
        $this->assertSame($this->messageFactory, $placeDetail->getMessageFactory());
        $this->assertSame($this->serializer, $placeDetail->getSerializer());
        $this->assertSame(PlaceDetailService::FORMAT_JSON, $placeDetail->getFormat());
        $this->assertFalse($placeDetail->hasBusinessAccount());
    }

    public function testPlaceDetailFormat()
    {
        $this->loadConfiguration($this->container, 'place_detail_format');
        $this->container->compile();

        $this->assertSame(
            PlaceDetailService::FORMAT_XML,
            $this->container->get('ivory.google_map.place_detail')->getFormat()
        );
    }

    public function testPlaceDetailApiKey()
    {
        $this->loadConfiguration($this->container, 'place_detail_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.place_detail')->getKey());
    }

    public function testPlaceDetailBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'place_detail_business_account');
        $this->container->compile();

        $placeDetail = $this->container->get('ivory.google_map.place_detail');

        $this->assertTrue($placeDetail->hasBusinessAccount());
        $this->assertSame('my-client', $placeDetail->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeDetail->getBusinessAccount()->getSecret());
        $this->assertFalse($placeDetail->getBusinessAccount()->hasChannel());
    }

    public function testPlaceDetailBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'place_detail_business_account_channel');
        $this->container->compile();

        $placeDetail = $this->container->get('ivory.google_map.place_detail');

        $this->assertTrue($placeDetail->hasBusinessAccount());
        $this->assertSame('my-client', $placeDetail->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeDetail->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $placeDetail->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceDetailBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'place_detail_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceDetailInvalid()
    {
        $this->loadConfiguration($this->container, 'place_detail_invalid');
        $this->container->compile();
    }

    public function testPlacePhoto()
    {
        $this->loadConfiguration($this->container, 'place_photo');
        $this->container->compile();

        $placePhoto = $this->container->get('ivory.google_map.place_photo');

        $this->assertInstanceOf(PlacePhotoService::class, $placePhoto);
        $this->assertFalse($placePhoto->hasKey());
        $this->assertFalse($placePhoto->hasBusinessAccount());
    }

    public function testPlacePhotoApiKey()
    {
        $this->loadConfiguration($this->container, 'place_photo_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.place_photo')->getKey());
    }

    public function testPlacePhotoBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'place_photo_business_account');
        $this->container->compile();

        $placePhoto = $this->container->get('ivory.google_map.place_photo');

        $this->assertTrue($placePhoto->hasBusinessAccount());
        $this->assertSame('my-client', $placePhoto->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placePhoto->getBusinessAccount()->getSecret());
        $this->assertFalse($placePhoto->getBusinessAccount()->hasChannel());
    }

    public function testPlacePhotoBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'place_photo_business_account_channel');
        $this->container->compile();

        $placePhoto = $this->container->get('ivory.google_map.place_photo');

        $this->assertTrue($placePhoto->hasBusinessAccount());
        $this->assertSame('my-client', $placePhoto->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placePhoto->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $placePhoto->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlacePhotoBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'place_photo_business_account_invalid');
        $this->container->compile();
    }

    public function testPlaceSearch()
    {
        $this->loadConfiguration($this->container, 'place_search');
        $this->container->compile();

        $placeSearch = $this->container->get('ivory.google_map.place_search');

        $this->assertInstanceOf(PlaceSearchService::class, $placeSearch);
        $this->assertSame($this->client, $placeSearch->getClient());
        $this->assertSame($this->messageFactory, $placeSearch->getMessageFactory());
        $this->assertSame($this->serializer, $placeSearch->getSerializer());
        $this->assertSame(PlaceSearchService::FORMAT_JSON, $placeSearch->getFormat());
        $this->assertFalse($placeSearch->hasBusinessAccount());
    }

    public function testPlaceSearchFormat()
    {
        $this->loadConfiguration($this->container, 'place_search_format');
        $this->container->compile();

        $this->assertSame(
            PlaceSearchService::FORMAT_XML,
            $this->container->get('ivory.google_map.place_search')->getFormat()
        );
    }

    public function testPlaceSearchApiKey()
    {
        $this->loadConfiguration($this->container, 'place_search_api_key');
        $this->container->compile();

        $this->assertSame('key', $this->container->get('ivory.google_map.place_search')->getKey());
    }

    public function testPlaceSearchBusinessAccount()
    {
        $this->loadConfiguration($this->container, 'place_search_business_account');
        $this->container->compile();

        $placeSearch = $this->container->get('ivory.google_map.place_search');

        $this->assertTrue($placeSearch->hasBusinessAccount());
        $this->assertSame('my-client', $placeSearch->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeSearch->getBusinessAccount()->getSecret());
        $this->assertFalse($placeSearch->getBusinessAccount()->hasChannel());
    }

    public function testPlaceSearchBusinessAccountChannel()
    {
        $this->loadConfiguration($this->container, 'place_search_business_account_channel');
        $this->container->compile();

        $placeSearch = $this->container->get('ivory.google_map.place_search');

        $this->assertTrue($placeSearch->hasBusinessAccount());
        $this->assertSame('my-client', $placeSearch->getBusinessAccount()->getClientId());
        $this->assertSame('my-secret', $placeSearch->getBusinessAccount()->getSecret());
        $this->assertSame('my-channel', $placeSearch->getBusinessAccount()->getChannel());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceSearchBusinessAccountInvalid()
    {
        $this->loadConfiguration($this->container, 'place_search_business_account_invalid');
        $this->container->compile();
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testPlaceSearchInvalid()
    {
        $this->loadConfiguration($this->container, 'place_search_invalid');
        $this->container->compile();
    }

    public function testTimeZone()
    {
        $this->loadConfiguration($this->container, 'time_zone');
        $this->container->compile();

        $timeZone = $this->container->get('ivory.google_map.time_zone');

        $this->assertInstanceOf(TimeZoneService::class, $timeZone);
        $this->assertSame($this->client, $timeZone->getClient());
        $this->assertSame($this->messageFactory, $timeZone->getMessageFactory());
        $this->assertSame($this->serializer, $timeZone->getSerializer());
        $this->assertSame(TimeZoneService::FORMAT_JSON, $timeZone->getFormat());
        $this->assertFalse($timeZone->hasBusinessAccount());
    }

    public function testTimeZoneFormat()
    {
        $this->loadConfiguration($this->container, 'time_zone_format');
        $this->container->compile();

        $this->assertSame(TimeZoneService::FORMAT_XML, $this->container->get('ivory.google_map.time_zone')->getFormat());
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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|SerializerInterface
     */
    private function createSerializerMock()
    {
        return $this->createMock(SerializerInterface::class);
    }
}
