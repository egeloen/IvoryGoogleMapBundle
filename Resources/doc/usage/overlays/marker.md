# Marker

Markers identify locations on the map. By default, they use a standard icon.

## Build your marker

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.marker`` service is. The configuration describes
below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    marker:
        # Your own marker class
        class: "My\Fucking\Marker"

        # Your own marker helper class
        helper_class: "My\Fucking\MarkerHelper"

        # Prefix used for the generation of the marker javascript variable
        prefix_javascript_variable: "marker_"

        # Position of the marker
        position:
            latitude: 0
            longitude: 0
            no_wrap: true

        # Marker animation
        # Available animation: bounce, drop
        # By default, there is no animation
        animation: "drop"

        # Custom marker options
        # By default there is no marker options
        options:
            clickable: false
            flat: true
```

``` php
<?php

// Requests the ivory google map marker service
$marker = $this->get('ivory_google_map.marker');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker.md).
```

### Marker image

The complete marker image configuration is available
[here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker_image.md).


### Marker shape

The complete marker shape configuration is available
[here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker_shape.md).
