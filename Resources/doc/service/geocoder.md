# Geocoder

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into geographic
coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or position the map.
Additionally, the service allows you to perform the converse operation (turning coordinates into addresses). This
process is known as "reverse geocoding".

## Dependencies

The Geocoder API uses [Geocoder](http://github.com/willdurand/Geocoder) which is the most popular PHP Geocoder. So, 
first, I recommend you to read its documentation. To install it, read this [documentation](/Resources/doc/installation.md).

It also requires an http client and so, the library relies on [Httplug](http://httplug.io/) which is an http 
client abstraction library. To install it, read this [documentation](/Resources/doc/installation.md).

## Configuration

In order to use the directions service, you need to configure it.

### Http client and message factory

The http client and message factory are mandatory. They define which http client and message factory the geocoder 
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
    geocoder:
        client: httplug.client.default
        message_factory: httplug.message_factory.default
```

### Https

The https flag allows you to enable/disable https for your http request:

``` yaml
ivory_google_map:
    geocoder: 
        https: true
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    geocoder:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    geocoder:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    geocoder:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your geocoder service, you can fetch it from the container and use it as explained in the 
[documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/geocoder/geocoder.md)

``` php
$response = $this->container->get('ivory.google_map.geocoder')->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
```
