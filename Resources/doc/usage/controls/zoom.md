# Zoom control

The Zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level
of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom
left corner on touch devices.

## Build your zoom control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.zoom_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    zoom_control:
        # You own zoom control class
        class: "My\Fucking\ZoomControl"

        # Your own zoom control helper
        helper_class: "My\Fucking\ZoomControlHelper"

        # Zoom control position
        # Available zoom control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_left"

        # Zoom control style
        # Availbale zoom control style: default, large, small
        zoom_control_style: "default"
```

``` php
<?php

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/zoom.md).
