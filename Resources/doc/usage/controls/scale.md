# Scale control

The Scale control displays a map scale element. This control is not enabled by default.

## Build your scale control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.scale_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    scale_control:
        # You own scale control class
        class: "My\Fucking\ScaleControl"

        # Your own scale control helper
        helper_class: "My\Fucking\ScaleControlHelper"

        # Scale control position
        # Available scale control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "bottom_left"

        # Scale control style
        # Availbale scale control style: default
        scale_control_style: "default"
```

``` php
<?php

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition:
use Ivory\GoogleMap\Controls\ScaleControlStyle;

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');

// Configure your scale control
$scaleControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
```

## Configure your scale control position

For configurating the pan control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');

// Sets your control position
$scaleControl->setControlPosition(ControlPosition::TOP_LEFT);
$scaleControl->setControlPosition('top_left');

$scaleControl->setControlPosition(ControlPosition::TOP_CENTER);
$scaleControl->setControlPosition('top_center');

$scaleControl->setControlPosition(ControlPosition::TOP_RIGHT);
$scaleControl->setControlPosition('top_right');

$scaleControl->setControlPosition(ControlPosition::LEFT_TOP);
$scaleControl->setControlPosition('left_top');

$scaleControl->setControlPosition(ControlPosition::LEFT_CENTER);
$scaleControl->setControlPosition('left_center');

$scaleControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$scaleControl->setControlPosition('left_bottom');

$scaleControl->setControlPosition(ControlPosition::RIGHT_TOP);
$scaleControl->setControlPosition('right_top');

$scaleControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$scaleControl->setControlPosition('right_center');

$scaleControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$scaleControl->setControlPosition('right_bottom');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$scaleControl->setControlPosition('bottom_left');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$scaleControl->setControlPosition('bottom_center');

$scaleControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$scaleControl->setControlPosition('bottom_right');
```

## Configure your scale control style

For configurating the scale control style, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ScaleControlStyle`` is here. It allows you to access all constants which describe scale
control style. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ScaleControlStyle;

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');

// Sets your scale control style
$scaleControl->setScaleControlStyle(ScaleControlStyle::DEFAULT_);
```

## Add your scale control to the map

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\ScaleControlStyle;

// Requests the ivory google map scale control service
$scaleControl = $this->get('ivory_google_map.scale_control');

// Add your scale control to the map
$map->setScaleControl($scaleControl);
$map->setScaleControl(ControlPosition::BOTTOM_LEFT, ScaleControlStyle::DEFAULT_);
```
