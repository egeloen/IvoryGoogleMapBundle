# Time Zone

The Google Maps Time Zone API provides a simple interface to request the time zone for a location on the earth, as well 
as that location's time offset from UTC.

## Dependencies

The Time Zone API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library.

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the time zone service is disabled. In order to enable the service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the time zone 
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
    time_zone:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    time_zone:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    time_zone:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    time_zone:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your time zone service, you can fetch it from the container and use it as explained in the 
[documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/time_zone/time_zone.md)

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\TimeZone\TimeZoneRequest;

$request = new TimeZoneRequest(
   new Coordinate(39.6034810, -119.6822510),
   new \DateTime('@1331161200')
);

$response = $this->container->get('ivory.google_map.time_zone')->process($request);
```
