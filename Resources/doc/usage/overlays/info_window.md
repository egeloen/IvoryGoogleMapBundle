# Info window

Info window displays content in a floating window above the map. 
The info window looks a little like a comic-book word balloon. 
It has a content area and a tapered stem, where the tip of the stem is at a specified location on the map.

## Build your info window

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows you to use the given objects like they are.
The ``ivory_google_map.info_window`` service is. The configuration describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    info_window:
        # Prefix used for the generation of the info window javascript variable
        prefix_javascript_variable: "info_window_"
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
```
