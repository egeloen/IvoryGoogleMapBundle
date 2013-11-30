# Directions API

The Directions API uses [widop/http-adapter](http://github.com/widop/http-adapter) which is a PHP 5.3 library for
issuing http requests.

The Google Directions API is a service that calculates directions between locations using an HTTP request. You can
search for directions for several modes of transportation, include transit, driving, walking or cycling. Directions
may specify origins, destinations and waypoints either as text strings (e.g. "Chicago, IL" or "Darwin, NT, Australia")
or as latitude/longitude coordinates. The Directions API can return multi-part directions using a series of waypoints.

## Request the directions service

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.geocoder`` service is not one of them. The
configuration describes below is this default configuration but if you don't provide at least one value (for the
`directions` or `directions_request` nodes), the service will not be registered.

```
# app/config/config.yml

ivory_google_map:
    directions:
        # Enable the service
        enabled: true

        # Your own directions class
        class: "My\Fucking\Directions"

        # The http adapter
        adapter: "widop_http_adapter.curl"

        # The Directions API URL
        url: "http://maps.googleapis.com/maps/api/directions"

        # TRUE if the service uses HTTPS else FALSE
        https: false

        # The format used (json or xml)
        format: "json"
```

``` php
$directions = $this->get('ivory_google_map.directions');
```

If you want to use it with a business account, you can read this
[documentation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/business_account.md).

## Request a direction

``` php
$response = $directions->route('New York', 'Washington');
```

The directions service allows you to route a much more advance request. If you want to learn more, you can read this
[documentation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/directions/directions_request.md).

When you have requested your direction, the returned object is an
``Ivory\GoogleMap\Services\Directions\DirectionsResponse``. If you want to learn more about the response, you
can read this [documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/directions/directions.md).
