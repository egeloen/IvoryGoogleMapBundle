# UPGRADE

### 1.1.0 to 1.1.1

 * The event helper service (`ivory_google_map.helper.event`) & configuration parameter
   (`ivory_google_map.event.helper_class`) has been removed.

### 1.0.0 to 1.1.0

The business classes have been moved to a dedicated library for reuasibility purpose. If you're using Symfony 2.0.*,
you need to update your `deps` file:

```
[ivory-google-map]
    git=http://github.com/egeloen/ivory-google-map.git
```

Autoload the library:

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Ivory\\GoogleMap' => __DIR__.'/../vendor/ivory-google-map/src',
    // ...
);
```

Run the vendors script:

``` bash
$ php bin/vendors update
```
