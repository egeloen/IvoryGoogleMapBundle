# Geocoder Request

## Build a geocoder request

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.geocoder_request`` service is.

```
# app/config/config.yml

ivory_google_map:
    geocoder_request:
        # Your own geocoder request class
        class: "My\Fucking\GeocoderRequest"

        # The address that you want to geocode
        # By default, there is no address
        address: "address"

        # The coordinate for which you wish to obtain the closest, human-readable address (Reverse geocoding)
        # By default, there is no coordinate
        coordinate:
            latitude: 1.1
            longitude: 2.3
            no_wrap: true

        # The bounding box of the viewport within which to bias geocode results more prominently
        # By default, there is no bound
        bound:
            south_west:
                latitude: -2.1
                longitude: -1.2
                no_wrap: true
            north_east:
                latitude: 3.2
                longitude: 2.3
                no_wrap: true

        # The region code, specified as a ccTLD ("top-level domain") two-character value
        # By default, there is no region
        region: "en"

        # The language in which to return results.
        # If language is not supplied, the geocoder will attempt to use the native language of the domain from
        # which the request is sent wherever possible
        # By default, there is no language
        language: "en"

        # Indicates whether or not the geocoding request comes from a device with a location sensor
        # By default, the sensor is false
        sensor: false
```

``` php
<?php

/**
 * Requests & configure the ivory google map geocoder service
 *
 * @var Ivory\GoogleMap\Services\Geocoding\GeocoderRequest $request
 */
$request = $this->get('ivory_google_map.geocoder_request');
```

### By coding

``` php
<?php

/**
 * Requests & configure the ivory google map geocoder service
 *
 * @var Ivory\GoogleMap\Services\Geocoding\GeocoderRequest $request
 */
$request = $this->get('ivory_google_map.geocoder_request')
    // Set address
    ->setAddress('1600 Amphitheatre Parkway, Mountain View, CA')
    // Or set coordinate (reverse geocoding)
    ->setCoordinate(1.1, 2.1, true)
    ->setBound(-1.1, -2.1, 2.1, 1.1, true, true)
    ->setRegion('en')
    ->setLanguage('en')
    ->setSensor(false);
```

If you set an address & a coordinate, address takes precedence over coordinate.

## Geocoloate your request

``` php
<?php

// Requests the ivory google map geocoder service
$geocoder = $this->get('ivory_google_map.geocoder');

// Geocode your request
$response = $geocoder->geocode($request);
```
