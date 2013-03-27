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

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/polygon.md).
