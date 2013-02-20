# Directions Request

## Build a directions request

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.directions_request`` service is.

```
# app/config/config.yml

ivory_google_map:
    directions_request:
        # Your own directions request class
        class: "My\Fucking\DirectionsRequest"

        # TRUE if the directions should avoid highways else FALSE
        # By default there is no avoid highways.
        avoid_highways: true

        # TRUE if the directions should avoid tolls else FALSE
        # By default there is no avoid tolls.
        avoid_tolls: true

        # TRUE if the directions should optimize waypoints.
        # By default there is no optimize waypoints.
        optimize_waypoints: true

        # TRUE if the directions should provide route alternatives.
        # By default there is no route alternatives.
        provide_route_alternatives: true

        # The region used to filter the directions results.
        # By default there is no region.
        region: "us"

        # The language used for this request.
        # By default there is no language.
        language: "en"

        # The travel mode used to filter directions results.
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
 * Requests & configure the ivory google map directions request service
 *
 * @var Ivory\GoogleMap\Services\Directions\DirectionsRequest $request
 */
$request = $this->get('ivory_google_map.directions_request');
```

### By coding

``` php
<?php

/**
 * Requests & configure the ivory google map directions request service
 *
 * @var Ivory\GoogleMap\Services\Directions\DirectionsRequest $request
 */
$request = $this->get('ivory_google_map.directions_request');

// Set your origin
$request->setOrigin('New York')
$request->setOrigin(1.1, 2.1, true);

// Set your destination
$request->setDestination('Washington');
$request->setDestination(2.1, 1.1, true);

// Set your waypoints
$request->addWaypoint('Philadelphia');
$request->addWaypoint(1.2, 2.2, true);

// If you use waypoint, optimize it
$request->setOptimizeWaypoints(true);

$request->setAvoidHighways(true);
$request->setAvoidTolls(true);
$request->setProvideRouteAlternatives(true);

$request->setRegion('us');
$request->setLanguage('en');
$request->setTravelMode(TravelMode::DRIVING);
$request->setUnitSystem(UnitSystem::METRIC);
$request->setSensor(false);
```

## Route your request

``` php
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;

$request = new DirectionsRequest();

// Route your request
$response = $directions->route($request);
```
