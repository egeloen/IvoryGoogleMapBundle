# KML Layer

The Google Maps API supports the KML and GeoRSS data formats for displaying geographic information. For more
information, see official [documentation](http://code.google.com/apis/maps/documentation/javascript/layers.html#KMLLayers).

## Build your KML layer

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.kml_layer`` service is. The configuration describes
below is this default configuration.

```
# app/config/config.yml

ivory_goole_map:
    kml_layer:
        # Prefix used for the generation of the KML layer javascript variable
        prefix_javascript_variable: "kml_layer_"

        # Your own kml layer class
        class: "My\Fucking\KMLLayer"

        # Your own kml layer helper class
        helper_class: "My\Fucking\KMLLayerHelper"

        # KML layer url
        url: "http://domain.com/kml_layer.kml"

        # Custom KML layer options
        # By default, there is no options
        options:
            clickable: true
            suppressInfoWindows: false
```

``` php
<?php

// Requests the ivory google map KML layer service
$kmlLayer = $this->get('ivory_google_map.kml_layer');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/layers/kml_layer.md).
