# Direction

The Google Direction API is a service that calculates direction between locations using an HTTP request. You can
search for direction for several modes of transportation, include transit, driving, walking or cycling. Direction
may specify origins, destinations and waypoints either as text strings (e.g. "Chicago, IL" or "Darwin, NT, Australia")
or as latitude/longitude coordinates. The Direction API can return multi-part direction using a series of waypoints.

## Dependencies

The Direction API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library. 

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the direction service is disabled. In order to enable the service, you need to configure it.

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
    direction:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    direction:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    direction:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    direction:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your direction service, you can fetch it from the container and use it as explained in the 
[documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/direction/direction.md)

``` php
use Ivory\GoogleMap\Service\Base\Location\AddressLocation;
use Ivory\GoogleMap\Service\Direction\Request\DirectionRequest;

$request = new DirectionRequest(
   new AddressLocation('New York'), 
   new AddressLocation('Washington')
);

$response = $this->container->get('ivory.google_map.direction')->route($request);
```
