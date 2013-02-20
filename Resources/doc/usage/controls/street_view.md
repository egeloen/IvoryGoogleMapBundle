# Street view control

The Street View control contains a Pegman icon which can be dragged onto the map to enable Street View. This control
appears by default in the top left corner of the map.

## Build your street view control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.street_view_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    street_view_control:
        # You own street view control class
        class: "My\Fucking\StreetViewControl"

        # Your own street view control helper
        helper_class: "My\Fucking\StreetViewControlHelper"

        # Street view control position
        # Available street view control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_left"
```

``` php
<?php

// Requests the ivory google map street view control service
$streetViewControl = $this->get('ivory_google_map.street_view_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map street view control service
$streetViewControl = $this->get('ivory_google_map.street_view_control');

// Configure your street view control
$streetViewControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the street view control position

For configurating the street view control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map street view control service
$streetViewControl = $this->get('ivory_google_map.street_view_control');

// Sets your control position
$streetViewControl->setControlPosition(ControlPosition::TOP_LEFT);
$streetViewControl->setControlPosition('top_left');

$streetViewControl->setControlPosition(ControlPosition::TOP_CENTER);
$streetViewControl->setControlPosition('top_center');

$streetViewControl->setControlPosition(ControlPosition::TOP_RIGHT);
$streetViewControl->setControlPosition('top_right');

$streetViewControl->setControlPosition(ControlPosition::LEFT_TOP);
$streetViewControl->setControlPosition('left_top');

$streetViewControl->setControlPosition(ControlPosition::LEFT_CENTER);
$streetViewControl->setControlPosition('left_center');

$streetViewControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$streetViewControl->setControlPosition('left_bottom');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_TOP);
$streetViewControl->setControlPosition('right_top');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$streetViewControl->setControlPosition('right_center');

$streetViewControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$streetViewControl->setControlPosition('right_bottom');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$streetViewControl->setControlPosition('bottom_left');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$streetViewControl->setControlPosition('bottom_center');

$streetViewControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$streetViewControl->setControlPosition('bottom_right');
```

## Add your street view control to the map

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map street view control service
$streetViewControl = $this->get('ivory_google_map.street_view_control');

// Add your street view control to the map
$map->setStreetViewControl($streetViewControl);
$map->setStreetViewControl(ControlPosition::TOP_LEFT);
```
