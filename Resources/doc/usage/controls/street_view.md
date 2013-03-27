# Street view control

The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control
appears by default in the top left corner of the map.

## Build your street view control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.street_view_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    street_view_control:
        # You own street view control class
        class: "My\Fucking\StreetViewControl"

        # Your own street view control helper
        helper_class: "My\Fucking\StreetViewControlHelper"

        # Street view control position
        # Available street view control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_left"
```

``` php
<?php

// Requests the ivory google map street view control service
$streetViewControl = $this->get('ivory_google_map.street_view_control');
```

### By coding

If you wan to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/street_view.md).
