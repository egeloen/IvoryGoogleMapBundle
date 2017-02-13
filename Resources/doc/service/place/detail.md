# Place Detail API

The Place Detail service allows you to get detailed response for a place. Once you have a place_id or a reference from 
a Place Search, you can request more details about a particular establishment or point of interest by initiating a 
Place Details request. A Place Details request returns more comprehensive information about the indicated place such as 
its complete address, phone number, user rating and reviews.

## Dependencies

The Place Detail API requires an http client and a serializer. The library relies respectively on 
[Httplug](http://httplug.io/) which is an http client abstraction library and the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library. 

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the place detail service is disabled. In order to enable the service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the place 
detail service will use for issuing http requests.
 
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
    place_detail:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    place_detail:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    place_detail:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    place_detail:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your place detail service, you can fetch it from the container and use it as explained 
in the [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/place/detail/place_detail.md).

``` php
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequest;

$request = new PlaceDetailRequest('ChIJN1t_tDeuEmsRUsoyG83frY4');
$response = $this->container->get('ivory.google_map.place_detail')->process($request);
```
