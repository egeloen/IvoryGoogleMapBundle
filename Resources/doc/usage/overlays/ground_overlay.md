# Ground overlay

Polygons are useful overlays to represent arbitrarily-sized areas, but they cannot display images. If you have an
image that you wish to place on a map, you can use a GroundOverlay object.

## Build your ground overlay

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.ground_overlay`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    ground_overlay:
        # Your own marker class
        class: "My\Fucking\GroundOverlay"

        # Your own ground overlay helper class
        helper_class: "My\Fucking\GroundOverlayHelper"

        # Prefix used for the generation of the groune overlay javascript variable
        prefix_javascript_variable: "ground_overlay_"

        # Groud overlay image url
        url: "url"

        # Ground overlay bound
        bound:
            south_west:
                latitude: -1
                longitude: -1
                no_wrap: true
            north_east:
                latitude: 1
                longitude: 1
                no_wrap: true

        # Custom ground overlay options
        # By default, there is no options
        options:
            clickable: false
```

``` php
<?php

// Requests the ivory google map ground overlay service
$groundOverlay = $this->get('ivory_google_map.ground_overlay');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/ground_overlay.md).
