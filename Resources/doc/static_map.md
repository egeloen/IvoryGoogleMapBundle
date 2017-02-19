# Static Map

## Build

First of all, if you want to render a static map, you will need to build one:

``` php
use Ivory\GoogleMap\Map;

$map = new Map();
```

Then, you can manipulate it as explained in the library [documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage.md).

## Configuration

You can configure some global options related to the API in order to update its behavior.

### API key

The API key allows you to bypass Google limitation according to your account plan:

``` yaml
ivory_google_map:
    static_map:
        api_key: ~
```

### Api secret

The API secret allows you to sign your request (even without Premium account):

``` yaml
ivory_google_map:
    static_map:
        business_acount:
            secret: ~
```

### Business account

The business account allows you to use Google Premium account:

``` yaml
ivory_google_map:
    static_map:
        business_acount:
            client_id: ~
            secret: ~
            channel: ~
```

## Render

Once, your map is ready to be rendered, you should rely on the built-in helpers allowing you to easily render your map 
according to your templating engine.

### Twig

If you're using Twig, the most easy way to render a map is:

``` twig
<img src="{{ ivory_google_map_static(map) }}" />
```

### Php

If you're using the PHP templating engine, then, the most easy way to render a map is:

``` php
<img src="<?php echo $view['ivory_google_map_static']->render($map) ?>" />
```
