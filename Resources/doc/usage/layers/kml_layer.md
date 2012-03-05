# KML Layer

The Google Maps API supports the KML and GeoRSS data formats for displaying geographic information. For more information, see official [documentation](http://code.google.com/apis/maps/documentation/javascript/layers.html#KMLLayers).

## Build your KML layer

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows you to use the given objects like they are.
The ``ivory_google_map.kml_layer`` service is. The configuration describes below is this default configuration.

```
# app/config/config.yml

ivory_goole_map:
    kml_layer:
        # Prefix used for the generation of the KML layer javascript variable
        prefix_javascript_variable: "kml_layer_"

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

``` php
<?php

// Requests the ivory google map KML layer service
$kmlLayer = $this->get('ivory_google_map.kml_layer');

// Configure your KML layer options
$kmlLayer->setPrefixJavascriptVariable('kml_layer_');
$kmlLayer->setUrl('http://www.domain.com/kml_layer.kml');

$kmlLayer->setOption('clickable', true);
$kmlLayer->setOption('suppressInfoWindows', false);
$kmlLayer->setOptions(array(
    'clickable' => true,
    'suppressInfoWindows' => false
));
```

## Add your KML layer to the map

``` php
<?php

// Requests the ivory google map KML layer service
$kmlLayer = $this->get('ivory_google_map.kml_layer');

// Add your KML layer to the map
$map->addKMLLayer($kmlLayer);
```
