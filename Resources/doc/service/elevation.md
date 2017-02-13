# Elevation

The Google Maps Elevation API provides a simple interface to query locations on the earth for elevation data. 
Additionally, you may request sampled elevation data along paths, allowing you to calculate elevation changes along 
routes.

## Dependencies

The Elevation API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library.

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the elevation service is disabled. In order to enable the service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the direction 
service will use for issuing http requests.
 
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
    elevation:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    elevation:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    elevation:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    elevation:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your elevation service, you can fetch it from the container and use it as explained in the 
[documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/elevation/elevation.md)

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Location\CoordinateLocation;
use Ivory\GoogleMap\Service\ELevation\PositionalElevationRequest;

$request = new PositionalElevationRequest([
   new CoordinateLocation(new Coordinate(40.714728, -73.998672)),
   new CoordinateLocation(new Coordinate(-34.397, 150.644)),
]);

$response = $this->container->get('ivory.google_map.direction')->route($request);
```
