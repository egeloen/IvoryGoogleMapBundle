# Pan control

The Pan control displays buttons for panning the map. This control appears by default in the top left corner of the
map on non-touch devices. The Pan control also allows you to rotate 45° imagery, if available.

## Build your pan control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.pan_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    pan_control:
        # You own pan control class
        class: "My\Fucking\PanControl"

        # Your own pan control helper
        helper_class: "My\Fucking\PanControlHelper"

        # Pan control position
        # Available pan control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: top_left
```

``` php
<?php

// Requests the ivory google map pan control service
$panControl = $this->get('ivory_google_map.pan_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map pan control service
$panControl = $this->get('ivory_google_map.pan_control');

// Configure your pan control
$panControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the pan control position

For configurating the pan control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map pan control service
$panControl = $this->get('ivory_google_map.pan_control');

// Sets your control position
$panControl->setControlPosition(ControlPosition::TOP_LEFT);
$panControl->setControlPosition('top_left');

$panControl->setControlPosition(ControlPosition::TOP_CENTER);
$panControl->setControlPosition('top_center');

$panControl->setControlPosition(ControlPosition::TOP_RIGHT);
$panControl->setControlPosition('top_right');

$panControl->setControlPosition(ControlPosition::LEFT_TOP);
$panControl->setControlPosition('left_top');

$panControl->setControlPosition(ControlPosition::LEFT_CENTER);
$panControl->setControlPosition('left_center');

$panControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$panControl->setControlPosition('left_bottom');

$panControl->setControlPosition(ControlPosition::RIGHT_TOP);
$panControl->setControlPosition('right_top');

$panControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$panControl->setControlPosition('right_center');

$panControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$panControl->setControlPosition('right_bottom');

$panControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$panControl->setControlPosition('bottom_left');

$panControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$panControl->setControlPosition('bottom_center');

$panControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$panControl->setControlPosition('bottom_right');
```

## Add your pan control to the map

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map pan control service
$panControl = $this->get('ivory_google_map.pan_control');

// Add your pan control to the map
$map->setPanControl($panControl);
$map->setPanControl(ControlPosition::TOP_LEFT);
```
