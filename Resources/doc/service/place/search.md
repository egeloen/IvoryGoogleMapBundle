# Place Search API

The Place Search API Web Service allows you to query for place information on a variety of categories, such as: 
establishments, prominent points of interest, geographic locations, and more. You can search for places either by 
proximity or a text string. A Place Search returns a list of places along with summary information about each place.

## Dependencies

The Place Autocomplete API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library. 

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the place search service is disabled. In order to enable the service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the place 
search service will use for issuing http requests.
 
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
    place_search:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    place_search:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    place_search:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    place_search:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your place search service, you can fetch it from the container and use it as explained 
in the [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/place/search/place_search.md).

``` php
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Place\Search\Request\NearbyPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\PlaceSearchRankBy;

$request = new NearbyPlaceSearchRequest(
    new Coordinate(-33.8670522, 151.1957362),
    PlaceSearchRankBy::PROMINENCE,
    1000
);

$iterator = $this->container->get('ivory.google_map.place_search')->process($request);
```
