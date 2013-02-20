# Polygon

Polygon objects are similar to polyline objects in that they consist of a series of coordinates in an ordered sequence.
However, instead of being open-ended, polygons are designed to define regions within a closed loop.

## Build your polygon

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.polygon`` service is. The configuration describes
below is this default configuration.

```
# app/config/config.yml

ivory_google_map
    polygon:
        # Your own polygon class
        class: "My\Fucking\Polygon"

        # Your own polygon helper class
        helper_class: "My\Fucking\PolygonHelper"

        # Prefix used for the generation of the polygon javascript variable
        prefix_javascript_variable: "polygon_"

        # Custom polygon options
        # By default, there is no options
        options:
            fillColor: "#000000"
            fillOpacity: 0.5
```

``` php
<?php

// Requests the ivory google map polygon service
$polygon = $this->get('ivory_google_map.polygon');
```

### By coding

``` php
<?php

// Requests the ivory google map polygon service
$polygon = $this->get('ivory_google_map.polygon');

// Configure your polygon options
$polygon->setPrefixJavascriptVariable('polygon_');

$polygon->setOption('fillColor', '#000000');
$polygon->setOption('fillOpacity', 0.5);
$polygon->setOptions(array(
    'fillColor' => '#000000',
    'fillOpacity' => 0.5
));
```

## Add coordinate to your polygon

Like describe in the introduction, a polygon object consists of an array of coordinates. So, you need to add
coordinate to your polygon.

``` php
<?php

// Requests the ivory google map polygon service
$polygon = $this->get('ivory_google_map.polygon');

// Add coordinates to your polygon
$polygon->addCoordinate(0, 0, true);
$polygon->addCoordinate(1, 1, true);
```

## Add your polygon to the map

``` php
<?php

// Requests the ivory google map polygon service
$polygon = $this->get('ivory_google_map.polygon');

// Add your polygon to the map
$map->addPolygon($polygon);
```
