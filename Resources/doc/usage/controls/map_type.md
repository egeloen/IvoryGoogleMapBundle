# Map type control

The map type control lets the user toggle between map types (such as ROADMAP and SATELLITE). This control appears by
default in the top right corner of the map.

## Build your map type control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.map_type_control`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    map_type_control:
        # You own map type control class
        class: "My\Fucking\MapTypeControl"

        # Your own map type control helper
        helper_class: "My\Fucking\MapTypeControlHelper"

        # Map type ids of the map type control
        # Available map type ids : roadmap, satellite, hybrid, terrain
        map_type_ids: ["roadmap", "satellite"]

        # Map type control position
        # Available map type control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: "top_right"

        # Map type control style
        # Availbale map type control style : default, dropdown_menu, horizontal_bar
        map_type_control_style: "default"
```

``` php
<?php

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');
```

### By coding

``` php
<?php

use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');

// Configure your map type control
$mapTypeControl->setMapTypeIds(array(MapTypeId::ROADMAP, MapTypeId::SATELLITE));

$mapTypeControl->addMapTypeId(MapTypeId::ROADMAP);
$mapTypeControl->addMapTypeId(MapTypeId::SATELLITE);

$mapTypeControl->setControlPosition(ControlPosition::TOP_RIGHT);

$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DEFAULT_);
```

## Configure the map type control IDs

For configurating the map type ids, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\MapTypeId`` is here. It allows you to access all constants which describe map types. If you don't
want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\MapTypeId;

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');

// Add your map type
$mapTypeControl->addMapTypeId(MapTypeId::HYBRID);
$mapTypeControl->addMapTypeId('hybrid');

$mapTypeControl->addMapTypeId(MapTypeId::ROADMAP);
$mapTypeControl->addMapTypeId('roadmap');

$mapTypeControl->addMapTypeId(MapTypeId::SATELLITE);
$mapTypeControl->addMapTypeId('satellite');

$mapTypeControl->addMapTypeId(MapTypeId::TERRAIN);
$mapTypeControl->addMapTypeId('terrain');
```

## Configure the map type control position

For configurating the map type control position, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\ControlPosition`` is here. It allows you to access all constants which describe control
position. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\ControlPosition;

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');

// Sets your control position
$mapTypeControl->setControlPosition(ControlPosition::TOP_LEFT);
$mapTypeControl->setControlPosition('top_left');

$mapTypeControl->setControlPosition(ControlPosition::TOP_CENTER);
$mapTypeControl->setControlPosition('top_center');

$mapTypeControl->setControlPosition(ControlPosition::TOP_RIGHT);
$mapTypeControl->setControlPosition('top_right');

$mapTypeControl->setControlPosition(ControlPosition::LEFT_TOP);
$mapTypeControl->setControlPosition('left_top');

$mapTypeControl->setControlPosition(ControlPosition::LEFT_CENTER);
$mapTypeControl->setControlPosition('left_center');

$mapTypeControl->setControlPosition(ControlPosition::LEFT_BOTTOM);
$mapTypeControl->setControlPosition('left_bottom');

$mapTypeControl->setControlPosition(ControlPosition::RIGHT_TOP);
$mapTypeControl->setControlPosition('right_top');

$mapTypeControl->setControlPosition(ControlPosition::RIGHT_CENTER);
$mapTypeControl->setControlPosition('right_center');

$mapTypeControl->setControlPosition(ControlPosition::RIGHT_BOTTOM);
$mapTypeControl->setControlPosition('right_bottom');

$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_LEFT);
$mapTypeControl->setControlPosition('bottom_left');

$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_CENTER);
$mapTypeControl->setControlPosition('bottom_center');

$mapTypeControl->setControlPosition(ControlPosition::BOTTOM_RIGHT);
$mapTypeControl->setControlPosition('bottom_right');
```

## Configure the map type control style

For configurating the map type control style, the better way is to follow the oriented object way. For that, the
``Ivory\GoogleMap\Controls\MapTypeControlStyle`` is here. It allows you to access all constants which describe map
type control style. If you don't want to use this class, you can directly use the constant value.

``` php
<?php

use Ivory\GoogleMap\Controls\MapTypeControlStyle;

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');

// Sets your map type control style
$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DEFAULT_);
$mapTypeControl->setMapTypeControlStyle('default');

$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::DROPDOWN_MENU);
$mapTypeControl->setMapTypeControlStyle('dropdown_menu');

$mapTypeControl->setMapTypeControlStyle(MapTypeControlStyle::HORIZONTAL_BAR);
$mapTypeControl->setMapTypeControlStyle('horizontal_bar');
```

## Add your map type control to the map

``` php
<?php

use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;

// Requests the ivory google map type control service
$mapTypeControl = $this->get('ivory_google_map.map_type_control');

// Add your map type control to the map
$map->setMapTypeControl($mapTypeControl);
$map->setMapTypeControl(
    array(MapTypeId::ROADMAP, MapTypeId::SATELLITE),
    ControlPosition::TOP_RIGHT,
    MapTypeControlStyle::DEFAULT_
);
```
