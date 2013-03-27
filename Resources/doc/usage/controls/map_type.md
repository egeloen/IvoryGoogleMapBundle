# Map type control

The map type control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by
default in the top right corner of the map.

## Build your map type control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.map_type_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    map_type_control:
        # You own map type control class
        class: "My\Fucking\MapTypeControl"

        # Your own map type control helper
        helper_class: "My\Fucking\MapTypeControlHelper"

        # Map type ids of the map type control
        # Available map type ids : roadmap, satellite, hybrid, terrain
        map_type_ids: ["roadmap", "satellite"]

        # Map type control position
        # Available map type control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_right"

        # Map type control style
        # Availbale map type control style : default, dropdown_menu, horizontal_bar
        map_type_control_style: "default"
```

``` php
<?php

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');
```

### By coding

If you want to lean more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/map_type.md).
