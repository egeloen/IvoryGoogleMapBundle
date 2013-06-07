# Distance Matrix Request

## Build a distance matrix request

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.distance_matrix_request`` service is.

```
# app/config/config.yml

ivory_google_map:
    distance_matrix_request:
        # Your own distance matrix request class
        class: "My\Fucking\DirectionsRequest"

        # TRUE if the distance matrix should avoid highways else FALSE
        # By default there is no avoid highways.
        avoid_highways: true

        # TRUE if the distance matrix should avoid tolls else FALSE
        # By default there is no avoid tolls.
        avoid_tolls: true

        # The region used to filter the distance matrix results.
        # By default there is no region.
        region: "us"

        # The language used for this request.
        # By default there is no language.
        language: "en"

        # The travel mode used to filter distance matrix results.
        # By default there is no travel mode.
        travel_mode: "DRIVING"

        # The unit system used.
        # By default there is no unit system.
        unit_system: "METRIC"

        # Indicates whether or not the directions request comes from a device with a location sensor
        # By default, the sensor is false
        sensor: false
```

``` php
<?php

/**
 * Requests & configure the ivory google map distance matrix request service
 *
 * @var Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request
 */
$request = $this->get('ivory_google_map.distance_matrix_request');
```

### By coding

``` php
<?php

/**
 * Requests & configure the ivory google map distance matrix request service
 *
 * @var Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest $request
 */
$request = $this->get('ivory_google_map.distance_matrix_request');

// Set your origins
$request->setOrigins(array('New York'));
$request->setOrigins(array(new Coordinate(1.1, 2.1, true)));

// Set your destinations
$request->setDestinations(array('Washington'));
$request->setDestinations(array(new Coordinate(2.1, 1.1, true)));

$request->setAvoidHighways(true);
$request->setAvoidTolls(true);

$request->setRegion('us');
$request->setLanguage('en');
$request->setTravelMode(TravelMode::DRIVING);
$request->setUnitSystem(UnitSystem::METRIC);
$request->setSensor(false);
```
```

## Process your request

``` php
// Process your request
$response = $distanceMatrix->process($request);
```
