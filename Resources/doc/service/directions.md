# Directions

The Google Directions API is a service that calculates directions between locations using an HTTP request. You can
search for directions for several modes of transportation, include transit, driving, walking or cycling. Directions
may specify origins, destinations and waypoints either as text strings (e.g. "Chicago, IL" or "Darwin, NT, Australia")
or as latitude/longitude coordinates. The Directions API can return multi-part directions using a series of waypoints.

## Dependencies

The Directions API requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. To install it, read this [documentation](/Resources/doc/installation.md).

## Configuration

In order to use the directions service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the directions 
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
    directions:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Https

The https flag allows you to enable/disable https for your http request:

``` yaml
ivory_google_map:
    directions: 
        https: true
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    directions:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    directions:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    directions:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your directions service, you can fetch it from the container and use it as explained in the 
[documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/directions/directions.md)

``` php
use Ivory\GoogleMap\Service\Directions\DirectionsRequest;

$request = new DirectionsRequest('New York', 'Washington');
$response = $this->container->get('ivory.google_map.directions')->route($request);
```
