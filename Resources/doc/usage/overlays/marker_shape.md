# Marker shape

This object defines the marker shape to use in determination of a marker's clickable region. The shape consists of
two properties "type" and "coordinates" which define the general type of marker and coordinates specific to that
type of marker.

The format of this attribute depends on the value of the type and follows the w3 AREA coords specification found at
http://www.w3.org/TR/REC-html40/struct/objects.html#adef-coords. The coordinates attribute is an array of integers that
specify the pixel position of the shape relative to the top-left corner of the target image. The coordinates depend on
the value of type as follows:

 - circle: coordinates is [x1, y1, r] where x1, y2 are the coordinates of the center of the circle, and r is the
   radius of the circle.
 - poly: coordinates is [x1, y1, x2, y2 ... xn, yn] where each x, y pair contains the coordinates of one vertex of
   the polygon.
 - rect: coordinates is [x1, y1, x2, y2] where x1, y1 are the coordinates of the upper-left corner of the rectangle
   and x2, y2 are the coordinates of the lower-right coordinates of the rectangle.

## Build your marker shape

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.marker_shape`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    marker_shape:
        # Your own marker shape class
        class: "My\Fucking\MarkerShape"

        # Your own marker shape helper class
        helper_class: "My\Fucking\MarkerShapeHelper"

        # Prefix used for the generation of the marker shape javascript variable
        prefix_javascript_variable: "marker_shape_"

        # Marker shape type
        # Available marker shape type : circle, poly, rect
        type: "poly"

        # Marker shape coordinates
        # For a circle, the coordinates is [x1, y1, r] where x1, y2 are the coordinates of the center of the circle, and r is the radius of the circle.
        # For a poly, the coordinates is [x1, y1, x2, y2 ... xn, yn] where each x, y pair contains the coordinates of one vertex of the polygon.
        # For a rect, the coordinates is [x1, y1, x2, y2] where x1, y1 are the coordinates of the upper-left corner of the rectangle and x2, y2 are the coordinates of the lower-right coordinates of the rectangle.
        coordinates: [1, 1, 1, -1, -1, -1, -1, 1]
```

``` php
<?php

// Requests the ivory google map marker shape service
$markerShape = $this->get('ivory_google_map.marker_shape');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_shape.md).
