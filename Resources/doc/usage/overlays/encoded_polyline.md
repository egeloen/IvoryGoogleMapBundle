# Encoded Polyline

The Encoded Polyline class defines a [Polyline](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polyline.md)
which has been encoded using the algorithm described [here](http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html).

## Build your encoded polyline

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.encoded_polyline`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map
    encoded_polyline:
        # Your own encoded polyline class
        class: "My\Fucking\EncodedPolyline"

        # Your own encoded polyline helper class
        helper_class: "My\Fucking\EncodedPolylineHelper"

        # Prefix used for the generation of the encoded polyline javascript variable
        prefix_javascript_variable: "encoded_polyline_"

        # Custom encoded polyline options
        # All polyline options are available
        # By default, there is no options
        options:
            geodesic: true
            strokeColor: "#ffffff"
```

``` php
<?php

// Requests the ivory google map encoded polyline service
$encodedPolyline = $this->get('ivory_google_map.encoded_polyline');
```

### By coding

``` php
<?php

// Requests the ivory google map encoded polyline service
$encodedPolyline = $this->get('ivory_google_map.polyline');

// Configure your encoded polyline options
$polyline->setPrefixJavascriptVariable('polyline_');

$encodedPolyline->setValue('encoded_polyline_value');

$polyline->setOption('geodesic', true);
$polyline->setOption('strokeColor', '#ffffff');
$polyline->setOptions(array(
    'geodesic' => true,
    'strokeColor' => '#ffffff'
));
```

## Add your encoded polyline to the map

``` php
<?php

// Requests the ivory google map encoded polyline service
$encodedPolyline = $this->get('ivory_google_map.polyline');

// Configure your encoded polyline
// ...

// Add your encoded polyline to the map
$map->addEncodedPolyline($encodedPolyline);
```
