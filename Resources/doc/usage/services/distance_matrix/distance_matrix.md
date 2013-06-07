# Distance Matrix API

The Google Distance Matrix API is a service that provides travel distance and time for a matrix of origins and
destinations. The information returned is based on the recommended route between start and end points, as calculated
by the Google Maps API, and consists of rows containing duration and distance values for each pair.

This service does not return detailed route information. Route information can be obtained by passing the desired
single origin and destination to the
[Directions API](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/directions/directions.md).

## Request the distance matrix service

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.distance_matrix`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    distance_matrix:
        # Your own directions class
        class: "My\Fucking\DistanceMatrix"

        # The Directions API URL
        url: "http://maps.googleapis.com/maps/api/distancematrix"

        # TRUE if the service uses HTTPS else FALSE
        https: false

        # The format used (json or xml)
        format: "json"
```

``` php
<?php

/**
 * Requests the ivory google map distance matrix
 *
 * @var Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrix $distanceMatrix
 */
$distanceMatrix = $this->get('ivory_google_map.distance_matrix');
```

If you want to learn more about the service, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/distance_matrix/distance_matrix.md).

## Request a distance matrix

``` php
$response = $distanceMatrix->process(array('Vancouver BC'), array('San Francisco'));
```

The distance matrix allows you to process a much more advanced request. If you want to lear more, you can read this
[documentation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/distance_matrix/distance_matrix_request.md).

When you have requested your distance matrix, the returned object is an
``Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixResponse``. If you want to learn more about the response, you
can read this [documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/distance_matrix/distance_matrix.md).
