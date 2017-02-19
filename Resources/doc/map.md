# Map

## Build

First of all, if you want to render a map, you will need to build one:

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

Then, you can manipulate it as explained in the library [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage.md).

## Configuration

You can configure some global options related to the API in order to update its behavior. Be aware these options are 
shared with the [Place autocomplete](/Resources/doc/place_autocomplete.md).

### Debug

The `debug` option allows to get a nicely formatted output instead of the default output optimized for production:

``` yaml
ivory_google_map:
    map:
        debug: "%kernel.debug%"
```

### Language

The language allows you to configure your map language:

``` yaml
ivory_google_map:
    map:
        language: "%locale%"
```

### API key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    map:
        api_key: ~
```

## Render

Once, your map is ready to be rendered, you should rely on the built-in helpers allowing you to easily render your map 
according to your templating engine.

### Twig

If you're using Twig, the most easy way to render a map is:

``` twig
{{ ivory_google_map(map) }}
{{ ivory_google_api([map]) }}
```

The available Twig functions are:

 - `ivory_google_api`: Renders the Google API loading.
 - `ivory_google_map`: Renders the map container + javascript + stylesheet.
 - `ivory_google_map_container`: Renders the map container.
 - `ivory_google_map_js`: Renders the map javascript.
 - `ivory_google_map_css`: Renders the map stylesheet.

**Don't forget to always render the Google API loading after rendering your map.**

### Php

If you're using the PHP templating engine, then, the most easy way to render a map is:

``` php
<?php echo $view['ivory_google_map']->render($map) ?>
<?php echo $view['ivory_google_api']->render([$map]) ?>
```

The available helper methods are:

 - `ivory_google_api::render`: Renders the Google API loading.
 - `ivory_google_map::render`: Renders the map container + javascript + stylesheet.
 - `ivory_google_map::renderHtml`: Renders the map container.
 - `ivory_google_map::renderJavascript`: Renders the map javascript.
 - `ivory_google_map::renderStylesheet`: Renders the map stylesheet.
 
**Don't forget to always render the Google API loading after rendering your map.**
