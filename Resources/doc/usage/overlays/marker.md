# Marker

Markers identify locations on the map. By default, they use a standard icon.

## Build your marker

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows you to use the given objects like they are.
The ``ivory_google_map.marker`` service is. The configuration describes below is this default configuration.

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

// Requests the ivory google map marker service
$marker = $this->get('ivory_google_map.marker');

// Add your marker to the map
$map->addMarker($marker);
```

## Configure marker animation

For configurating the marker animation, the better way is to follow the oriented object way. For that, the ``Ivory\GoogleMapBundle\Model\Overlays\Animation`` is here.
It allows you to access all constants which describe marker animation. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMapBundle\Model\Overlays\Animation;

// Requests the ivory google map marker service
$marker = $this->get('ivory_google_map.marker');

// Sets your marker animation
$marker->setAnimation(Animation::BOUNCE);
$marker->setAnimation('bounce');

$marker->setAnimation(Animation::DROP);
$marker->setAnimation('drop');
```

## Configure marker icon

The complete marker icon configuration is available [here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker_image.md).

## Configure marker shadow

The complete marker shadow configuration is available [here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker_shadow.md).

## Configure marker shape

The complete marker shape configuration is available [here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker_shape.md).
