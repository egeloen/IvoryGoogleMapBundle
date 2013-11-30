# Geocoding API

The Geocoding API uses [Geocoder](http://github.com/willdurand/Geocoder) which is a PHP 5.3 library for issuing
Geocoding. So, I I recommend you to read his documentation.

Geocoding is the process of converting addresses (like "1600 Amphitheatre Parkway, Mountain View, CA") into
geographic coordinates (like latitude 37.423021 and longitude -122.083739), which you can use to place markers or
position the map.Additionally, the service allows you to perform the converse operation (turning coordinates into
addresses). This process is known as "reverse geocoding".

## Request a geocoder

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.geocoder`` service is not one of them. The
configuration describes below is this default configuration but if you don't provide at least one value (for the
`geocoder` or `geocoder_request` nodes), the service will not be registered.

```
# app/config/config.yml

ivory_google_map:
    geocoder:
        # Enable the service
        enabled: true

        # Geocoder class
        class: "Ivory\GoogleMap\Services\Geocoding\Geocoder"
        provider:
            # Fake IP
            # If you set a fake IP, the parameter will replace the REMOTE_ADDR value by the given one
            fake_ip: "123.345.567.123"

            # Provider class
            class: "Ivory\GoogleMap\Services\Geocoding\\Provider"

            # API key used by the provider
            # If you set an API key, this paremeter will be the second parameter provider constructor
            # By default, there is no api key ^_^
            api_key: "apikey"

            # Locale used by the provider
            # If your set a locale, this parameter will be the second parameter provider constructor if there is no api key else it will be the third
            # By default, there is no locale
            locale: "en"

        # Adapter class
        adapter: "Geocoder\HttpAdapter\BuzzHttpAdapter"
```

``` php
$geocoder = $this->get('ivory_google_map.geocoder');
```

If you want to learn more, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/geocoding/geocoder.md).

## The standard Geocoder

If you use the standard Geocoder components, I recommand you to directly read this own documentation available
[here](http://www.geocoder-php.org/).

## The Ivory Google Map Geocoder

The specific Ivory Google Map Geocoder has been added to allow you to geocode a very advanced request & use the
response to directly build your overlays. If you are interrested about this geocoder, the documentation is available
[here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/geocoding/ivory_geocoder.md).
