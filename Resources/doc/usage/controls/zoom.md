# Zoom control

The Zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level
of the map. This control appears by default in the top left corner of the map on non-touch devices or in the bottom
left corner on touch devices.

## Build your zoom control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.zoom_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    zoom_control:
        # You own zoom control class
        class: "My\Fucking\ZoomControl"

        # Your own zoom control helper
        helper_class: "My\Fucking\ZoomControlHelper"

        # Zoom control position
        # Available zoom control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_left"

        # Zoom control style
        # Availbale zoom control style: default, large, small
        zoom_control_style: "default"
```

``` php
<?php

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition:
use Ivory\GoogleMap\Controls\ZoomControlStyle;

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');

// Configure your zoom control
$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
```

## Configure your zoom control position

For configurating the zoom control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');

// Sets your control position
$zoomControl->setControlPosition(ControlPosition::TOP_LEFT);
$zoomControl->setControlPosition('top_left');

$zoomControl->setControlPosition(ControlPosition::TOP_CENTER);
$zoomControl->setControlPosition('top_center');

$zoomControl->setControlPosition(ControlPosition::TOP_RIGHT);
$zoomControl->setControlPosition('top_right');

$zoomControl->setControlPosition(ControlPosition::LEFT_TOP);
$zoomControl->setControlPosition('left_top');

$zoomControl->setControlPosition(ControlPosition::LEFT_CENTER);
$zoomControl->setControlPosition('left_center');

$zoomControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$zoomControl->setControlPosition('left_bottom');

$zoomControl->setControlPosition(ControlPosition::RIGHT_TOP);
$zoomControl->setControlPosition('right_top');

$zoomControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$zoomControl->setControlPosition('right_center');

$zoomControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$zoomControl->setControlPosition('right_bottom');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$zoomControl->setControlPosition('bottom_left');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$zoomControl->setControlPosition('bottom_center');

$zoomControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$zoomControl->setControlPosition('bottom_right');
```

## Configure your zoom control style

For configurating the zoom control style, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ZoomControlStyle`` is here. It allows you to access all constants which describe zoom
control style. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ZoomControlStyle;

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');

// Sets your zoom control style
$zoomControl->setZoomControlStyle(ZoomControlStyle::DEFAULT_);
$zoomControl->setZoomControlStyle('default');

$zoomControl->setZoomControlStyle(ZoomControlStyle::LARGE);
$zoomControl->setZoomControlStyle('large');

$zoomControl->setZoomControlStyle(ZoomControlStyle::SMALL);
$zoomControl->setZoomControlStyle('small');
```

## Add your zoom control to the map

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ZoomControlStyle;

// Requests the ivory google map zoom control service
$zoomControl = $this->get('ivory_google_map.zoom_control');

// Add your zoom control to the map
$map->setZoomControl($zoomControl);
$map->setZoomControl(ControlPosition::TOP_LEFT, ZoomControlStyle::DEFAULT_);
```
