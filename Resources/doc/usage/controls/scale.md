# Scale control

The Scale control displays a map scale element. This control is not enabled by default.

## Build your scale control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.scale_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    scale_control:
        # You own scale control class
        class: "My\Fucking\ScaleControl"

        # Your own scale control helper
        helper_class: "My\Fucking\ScaleControlHelper"

        # Scale control position
        # Available scale control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "bottom_left"

        # Scale control style
        # Availbale scale control style: default
        scale_control_style: "default"
```

``` php
<?php

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/controls/scale.md).
