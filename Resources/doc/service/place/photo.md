# Place Photo API

The Place Photo service, part of the Google Places API Web Service, is a read-only API that allows you to add high 
quality photographic content to your application. The Place Photo service gives you access to the millions of photos 
stored in the Places and Google+ Local database. When you get place information using a Place Details request, 
photo references will be returned for relevant photographic content. The Nearby Search and Text Search requests also 
return a single photo reference per place, when relevant. Using the Photo service you can then access the referenced 
photos and resize the image to the optimal size for your application. 

To install them, read this [documentation](/Resources/doc/installation.md).

## Configuration

By default, the place photo service is disabled. In order to enable the service, you need to configure it.

### Enable

If you want to enable the place photo service, you can use the following:

``` yaml
ivory_google_map:
    place_photo: ~
```

### Format

The format allows you to use json/xml format for your http request:

``` yaml
ivory_google_map:
    place_photo:
        format: json
```

### Api key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    place_photo:
        api_key: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    place_photo:
        business_account:
            client_id: ~
            secret: ~
            channel: ~
```

## Usage

Once you have configured your place photo service, you can fetch it from the container and use it as explained 
in the [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/service/place/photo/place_photo.md).

``` php
use Ivory\GoogleMap\Service\Place\Photo\Request\PlacePhotoRequest;

$request = new PlacePhotoRequest('CnRtAAAATLZNl354RwP_9UKbQ_5P');
$url = $this->container->get('ivory.google_map.place_photo')->process($request);
```
