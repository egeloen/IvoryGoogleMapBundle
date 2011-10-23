# Marker overlay

Markers identify locations on the map. By default, they use a standard icon.

## Build your marker

``` php
<?php

/**
 * Requests the ivory google map marker service
 *
 * @var Ivory\GoogleMapBundle\Model\Overlays\Marker $marker
 */
$marker = $this->get('ivory_google_map.marker');
```

## Configure your marker

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows you to use the given objects like they are.
The ``ivory_google_map.marker`` service is it. The configuration describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    marker:
        # Prefix used for the generation of the marker javascript variable
        prefix_javascript_variable: "marker_"

        # Position of the marker
        position:
            latitude: 0
            longitude: 0
            no_wrap: true

        # Marker animation
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

``` php
<?php

use Ivory\GoogleMapBundle\Model\Overlays\Animation;

// Requests the ivory google map marker service
$marker = $this->get('ivory_google_map.marker');

// Configure your marker options
$marker->setPrefixJavascriptVariable('marker_');
$marker->setPosition(0, 0, true);
$marker->setAnimation(Animation::DROP);

$marker->setOption('clickable', false);
$marker->setOption('flat', true);
$marker->setOptions(array(
    'clickable' => false,
    'flat' => true
));
```

## Add your marker to the map

Now you have configurated your marker, you need to add it to the map.

``` php
<?php

// Add your marker to the map
$map->addMarker($marker);
```

## Set the icon of your marker

Coming soon...

## Set the shadow of your marker

Coming soon...

## Set the shape to your marker

Coming soon...
