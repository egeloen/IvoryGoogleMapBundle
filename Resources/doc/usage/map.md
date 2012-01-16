# Map

## Build your map

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows you to use the given objects like they are.
The ``ivory_google_map.map`` service is. The configuration describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    map:
        # Prefix used for the generation of the map javascript variable
        prefix_javascript_variable: "map_"

        # HTML container ID used for the map container
        html_container: "map_canvas"

        # If this flag is enabled, the map will load asyncronous
        async: false

        # If this flag is enabled, the map will autozoom on the overlays added
        auto_zoom: false

        # Center coordinate of the map
        # If the autozoom flag is enabled, the center is not used
        center:
            longitude: 0
            latitude: 0
            no_wrap: true

        # Zoom of the map
        # If the autozoom flag is enabled, the zoom is not used
        zoom: 3

        # Bound of the map
        # If the auto zoom flag is not enabled, the bound is not used
        # If the bound extends overlays, coordinates of the overlays extended are used instead of these coordinates
        # By default, there is no bound
        bound:
            south_west:
                latitude: -2.1
                longitude: -3.9
                no_wrap: true
            north_east:
                latitude: 2.6
                longitude: 1.4
                no_wrap: true

        # Default map type
        # Available map type : hybrid, roadmap, satellite, terrain
        type: "roadmap"

        # Map width
        width: "300px"

        # Map height
        height: "300px"

        # Custom map options
        # By default, there is no map options
        map_options:
            disableDefaultUI: true
            disableDoubleClickZoom: true

        # Custom stylesheet options
        # By default, there is no stylesheet options except width & height
        stylesheet_options:
            border: "1px solid #000"
            background-color: "#fff"

        # google map Api language, default en
        language: en
```

``` php
<?php

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');
```

### By coding

``` php
<?php

use Ivory\GoogleMapBundle\Model\MapTypeId;

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');

// Configure your map options
$map->setPrefixJavascriptVariable('map_');
$map->setHtmlContainerId('map_canvas');

$map->setAsync(false);

$map->setAutoZoom(false);

$map->setCenter(0, 0, true);
$map->setMapOption('zoom', 3);

$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
$map->setMapOption('mapTypeId', 'roadmap');

$map->setMapOption('disableDefaultUI', true);
$map->setMapOption('disableDoubleClickZoom', true);
$map->setMapOptions(array(
    'disableDefaultUI' => true,
    'disableDoubleClickZoom' => true
));

$map->setStylesheetOption('width', '300px');
$map->setStylesheetOption('height', '300px');
$map->setStylesheetOptions(array(
    'width' => '300px',
    'height' => '300px'
));

$map->setLanguage('en');
```

## Configure map center & zoom

For configurating the map center & zoom, you have three possibilities:

   1. Standard center coordinate & zoom
   2. Fitting a bound
   3. Fitting a bound which extends overlays

### Standard center coordinate & zoom

To use the standard center coordinate & zoom, you need to disable the auto zoom flag & configure the center/zoom.

``` php
<?php

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');

// Disable the auto zoom flag
$map->setAutoZoom(false);

// Sets the center
$map->setCenter(0, 0, true);

// Sets the zoom
$map->setMapOption('zoom', 3);
```

### Fitting a bound

For fitting a bound, you need to enable the auto zoom flag & configure bound south west & nort east coordinates.
If you extend overlays with the bound, the map will fit the overlays coordinate instead of bound coordinates.

``` php
<?php

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');

// Enable the auto zoom flag
$map->setAutoZoom(true);

// Sets the bound coordinates
$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
```

### Fitting a bound which extends overlays

For fitting a bound which extends overlays, you need to enable the auto zoom flag & add overlays to the bound.
In the [overlays documentation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/index.md), you learn how you can add overlays to the map.
If the auto zoom flag is enabled and you add some overlays to the map, the map bound will automatically extends your overlay.
So, at the end, all your overlays will be visible on your sreen.

``` php
<?php

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');

// Enable the auto zoom flag
$map->setAutoZoom(true);

// Requests the ivory google map marker service for example
$marker = $this->get('ivory_google_map.marker');

// Add marker overlay to your map
$map->addMarker($marker);
```

## Configure map type

For configurating the map type, the better way is to follow the oriented object way. For that, the ``Ivory\GoogleMapBundle\Model\MapTypeId`` is here.
It allows you to access all constants which describe map types. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMapBundle\Model\MapTypeId

// Requests the ivory google map service
$map = $this->get('ivory_google_map.map');

// Sets your map type
$map->setMapOption('mapTypeId', MapTypeId::HYBRID);
$map->setMapOption('mapTypeId', 'hybrid');

$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
$map->setMapOption('mapTypeId', 'roadmap');

$map->setMapOption('mapTypeId', MapTypeId::SATELLITE);
$map->setMapOption('mapTypeId', 'satellite');

$map->setMapOption('mapTypeId', MapTypeId::TERRAIN);
$map->setMapOption('mapTypeId', 'terrain');
```

## Add overlays to your map

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom the map. 
Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of objects.

   1. [Marker](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker.md)
   2. [Info window](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/info_window.md)
   3. [Polyline](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polyline.md)
   4. [Polygon](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polygon.md)
   5. [Rectangle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/rectangle.md)
   6. [Circle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/circle.md)
   7. [Ground overlay](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/ground_overlay.md)

## Configure map control options

The maps on Google Maps contain UI elements for allowing user interaction through the map. 
These elements are known as controls and you can include variations of these controls in your Google Maps API application. 
Alternatively, you can do nothing and let the Google Maps API handle all control behavior.

   1. [Map type](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/map_type.md)
   2. [Overview](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/overview.md)
   3. [Pan](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/pan.md)
   4. [Rotate](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/rotate.md)
   5. [Scale](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/scale.md)
   6. [Street view](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/street_view.md)
   7. [Zoom](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/zoom.md)
