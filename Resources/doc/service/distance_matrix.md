# Distance Matrix

The Google Distance Matrix API is a service that provides travel distance and time for a matrix of origins and
destinations. The information returned is based on the recommended route between start and end points, as calculated
by the Google Maps API, and consists of rows containing duration and distance values for each pair.

This service does not return detailed route information. Route information can be obtained by passing the desired
single origin and destination to the [Direction API](/Resources/doc/service/direction.md).

## Dependencies

The Distance Matrix API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library.

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the distance matrix service is disabled. In order to enable the service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the distance 
matrix service will use for issuing http requests.
 
First, configure the [Httplug](http://httplug.io/) bundle.

``` yaml
httplug:
    classes:
        client: Http\Adapter\Guzzle6\Client
        message_factory: Http\Message\MessageFactory\GuzzleMessageFactory
    clients:
        acme:
            factory: httplug.factory.guzzle6
```

Then, configure the Google Map bundle:

``` yaml
ivory_google_map:
    distance_matrix:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    distance_matrix:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    distance_matrix:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    distance_matrix:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your distance matrix service, you can fetch it from the container and use it as explained in 
the [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/distance_matrix/distance_matrix.md)

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\DistanceMatrix\DistanceMatrixRequest;

$request = new DistanceMatrixRequest(
   [new AddressLocation('Vancouver BC')], 
   [new AddressLocation('San Francisco')]
);

$response = $this->container->get('ivory.google_map.distance_matrix')->process($request);
```
