# Polyline

The Polyline class defines a linear overlay of connected line segments on the map. A Polyline object consists of an
array of coordinates, and creates a series of line segments that connect those locations in an ordered sequence.

## Build your polyline

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.polyline`` service is. The configuration describes
below is this default configuration.

```
# app/config/config.yml

ivory_google_map
    polyline:
        # Your own polyline class
        class: "My\Fucking\Polyline"

        # Your own polyline helper class
        helper_class: "My\Fucking\PolylineHelper"

        # Prefix used for the generation of the polyline javascript variable
        prefix_javascript_variable: "polyline_"

        # Custom polyline options
        # By default, there is no options
        options:
            geodesic: true
            strokeColor: "#ffffff"
```

``` php
<?php

// Requests the ivory google map polyline service
$polyline = $this->get('ivory_google_map.polyline');
```

### By coding

``` php
<?php

// Requests the ivory google map polyline service
$polyline = $this->get('ivory_google_map.polyline');

// Configure your polyline options
$polyline->setPrefixJavascriptVariable('polyline_');

$polyline->setOption('geodesic', true);
$polyline->setOption('strokeColor', '#ffffff');
$polyline->setOptions(array(
    'geodesic' => true,
    'strokeColor' => '#ffffff'
));
```

## Add coordinate to your polyline

Like describe in the introduction, a polyline object consists of an array of coordinates. So, you need to add
coordinate to your polyline.

``` php
<?php

// Requests the ivory google map polyline service
$polyline = $this->get('ivory_google_map.polyline');

// Add coordinates to your polyline
$polyline->addCoordinate(0, 0, true);
$polyline->addCoordinate(1, 1, true);
```

## Add your polyline to the map

``` php
<?php

// Requests the ivory google map polyline service
$polyline = $this->get('ivory_google_map.polyline');

// Add your polyline to the map
$map->addPolyline($polyline);
```
