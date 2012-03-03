<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\Geocoder;

use Geocoder\HttpAdapter\BuzzHttpAdapter;
use Geocoder\Provider\GoogleMapsProvider;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Provider;

/**
 * Geocoder test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the geocode method with a geocoder provider
     */
    public function testGeocodeWithGeocoderProvider()
    {
        $adapter = new BuzzHttpAdapter();
        $provider = new GoogleMapsProvider($adapter);

        $geocoder = new Geocoder($provider);
        $response = $geocoder->geocode('address');

        $this->assertInstanceOf('Geocoder\Result\Geocoded', $response);
    }

    /**
     * Checks the geocode method with the ivory provider
     */
    public function testGeocodeWithIvoryProvider()
    {
        $adapter = new BuzzHttpAdapter();
        $provider = new Provider($adapter);

        $geocoder = new Geocoder($provider);
        $response = $geocoder->geocode('address');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }

    /**
     * Checks the reverse method with a geocoder provider
     */
    public function testReverseWithGeocoderProvider()
    {
        $adapter = new BuzzHttpAdapter();
        $provider = new GoogleMapsProvider($adapter);

        $geocoder = new Geocoder($provider);
        $response = $geocoder->reverse(1.1, 2.1);

        $this->assertInstanceOf('Geocoder\Result\Geocoded', $response);
    }

    /**
     * Checks the reverse method with the ivory provider
     */
    public function testReverseWithIvoryProvider()
    {
        $adapter = new BuzzHttpAdapter();
        $provider = new Provider($adapter);

        $geocoder = new Geocoder($provider);
        $response = $geocoder->reverse(1.1, 2.1);

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse', $response);
    }
}
