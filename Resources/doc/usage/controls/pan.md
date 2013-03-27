# Pan control

The Pan control displays buttons for panning the map. This control appears by default in the top left corner of the
map on non-touch devices. The Pan control also allows you to rotate 45° imagery, if available.

## Build your pan control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.pan_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    pan_control:
        # You own pan control class
        class: "My\Fucking\PanControl"

        # Your own pan control helper
        helper_class: "My\Fucking\PanControlHelper"

        # Pan control position
        # Available pan control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: top_left
```

``` php
<?php

// Requests the ivory google map pan control service
$panControl = $this->get('ivory_google_map.pan_control');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/pan.md).
