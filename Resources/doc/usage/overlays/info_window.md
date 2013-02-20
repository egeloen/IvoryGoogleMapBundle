# Info window

Info window displays content in a floating window above the map. The info window looks a little like a comic-book word
balloon. It has a content area and a tapered stem, where the tip of the stem is at a specified location on the map.

## Build your info window

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.info_window`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    info_window:
        # Your own marker class
        class: "My\Fucking\InfoWindow"

        # Your own info window helper class
        helper_class: "My\Fucking\InfoWindowHelper"

        # Prefix used for the generation of the info window javascript variable
        prefix_javascript_variable: "info_window_"

        # Poisition of the info window
        # It is used if the info window is directly added to the map
        # If you add an info window to a marker, it will not be used
        position:
            latitude: 0
            longitude: 0
            no_wrap: true

        # Info window pixel offset
        # By default, there is no pixel offset
        pixel_offset:
            width: 1.1
            height: 2.1
            width_unit: "px"
            height_unit: "pt"

        # Info window content
        content: "<p>Default content</p>"

        # Info window default open state
        # TRUE if the info window is opened else FALSE
        open: false

        # This flag is only used if you link an info window to a marker
        # If it is enabled, an event will be generated for allowing you to open the info window when you trigger
        # the event configured below on the linked marker
        auto_open: true

        # Info window open event
        # Available open event : click, dblclick, mouseup, mousedown, mouseover, mouseout
        open_event: "click"

        # If it is enabled, the info window will be closed each time an info window configurated with the auto
        # open flag is opened.
        auto_close: false

        # Custom info window options
        # By default, there is no options
        options:
            disableAutoPan: true
            zIndex: 10
```

``` php
<?php

// Requests the ivory google map info window service
$infoWindow = $this->get('ivory_google_map.info_window');
```

### By coding

``` php
<?php

// Requests the ivory google map info window service
$infoWindow = $this->get('ivory_google_map.info_window');

// Configure your info window options
$infoWindow->setPrefixJavascriptVariable('info_window_');
$infoWindow->setPosition(0, 0, true);
$infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
$infoWindow->setContent('<p>Default content</p>');
$infoWindow->setOpen(false);
$infoWindow->setAutoOpen(true);
$infoWindow->setOpenEvent(MouseEvent::CLICK);
$infoWindow->setAutoClose(false);
$infoWindow->setOption('disableAutoPan', true);
$infoWindow->setOption('zIndex', 10);
$infoWindow->setOptions(array(
    'disableAutoPan' => true,
    'zIndex' => 10
));
```

## Add your info window to the map

``` php
<?php

// Request the ivory google map info window service
$infoWindow = $this->get('ivory_google_map.info_window');

// Add your info window to the map
$map->addInfoWindow($infoWindow);
```

## Add your info window to the marker

``` php
<?php

// Request the ivory google map info window service
$infoWindow = $this->get('ivory_google_map.info_window');

// Add your info window to the marker
$marker->setInfoWindow($infoWindow);
```

## Configure info window open event

For configurating the info window open event, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Events\MouseEvent`` is here. It allows you to access all constants which describe open event. If you
don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Events\MouseEvent;

// Requests the ivory google map info window service
$infoWindow = $this->get('ivory_google_map.info_window');

// Sets your open event
$infoWindow->setOpenEvent(MouseEvent::CLICK);
$infoWindow->setOpenEvent('click');

$infoWindow->setOpenEvent(MouseEvent::DBLCLICK);
$infoWindow->setOpenEvent('dblclick');

$infoWindow->setOpenEvent(MouseEvent::MOUSEUP);
$infoWindow->setOpenEvent('mouseup');

$infoWindow->setOpenEvent(MouseEvent::MOUSEDOWN);
$infoWindow->setOpenEvent('mousedown');

$infoWindow->setOpenEvent(MouseEvent::MOUSEOVER);
$infoWindow->setOpenEvent('mouseover');

$infoWindow->setOpenEvent(MouseEvent::MOUSEOUT);
$infoWindow->setOpenEvent('mouseout');
```
