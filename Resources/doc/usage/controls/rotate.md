# Rotate control

The Rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. This
control appears by default in the top left corner of the map.

## Build your rotate control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.rotate_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    rotate_control:
        # You own rotate control class
        class: "My\Fucking\RotateControl"

        # Your own rotate control helper
        helper_class: "My\Fucking\RotateControlHelper"

        # Rotate control position
        # Available rotate control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: top_left
```

``` php
<?php

// Requests the ivory google map rotate control service
$rotateControl = $this->get('ivory_google_map.rotate_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map rotate control service
$rotateControl = $this->get('ivory_google_map.rotate_control');

// Configure your rotate control
$rotateControl->setControlPosition(ControlPosition::TOP_LEFT);
```

## Configure the rotate control position

For configurating the rotate control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map rotate control service
$rotateControl = $this->get('ivory_google_map.rotate_control');

// Sets your control position
$rotateControl->setControlPosition(ControlPosition::TOP_LEFT);
$rotateControl->setControlPosition('top_left');

$rotateControl->setControlPosition(ControlPosition::TOP_CENTER);
$rotateControl->setControlPosition('top_center');

$rotateControl->setControlPosition(ControlPosition::TOP_RIGHT);
$rotateControl->setControlPosition('top_right');

$rotateControl->setControlPosition(ControlPosition::LEFT_TOP);
$rotateControl->setControlPosition('left_top');

$rotateControl->setControlPosition(ControlPosition::LEFT_CENTER);
$rotateControl->setControlPosition('left_center');

$rotateControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$rotateControl->setControlPosition('left_bottom');

$rotateControl->setControlPosition(ControlPosition::RIGHT_TOP);
$rotateControl->setControlPosition('right_top');

$rotateControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$rotateControl->setControlPosition('right_center');

$rotateControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$rotateControl->setControlPosition('right_bottom');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$rotateControl->setControlPosition('bottom_left');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$rotateControl->setControlPosition('bottom_center');

$rotateControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$rotateControl->setControlPosition('bottom_right');
```

## Add your rotate control to the map

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map rotate control service
$rotateControl = $this->get('ivory_google_map.rotate_control');

// Add your rotate control to the map
$map->setRotateControl($rotateControl);
$map->setRotateControl(ControlPosition::TOP_LEFT);
```
