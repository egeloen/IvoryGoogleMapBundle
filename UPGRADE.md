# UPGRADE

### 2.0.2/2.1.2 to 2.0.3/2.1.3

 * The geocoder, directions & distance matrix services have been disabled by default in order to make the
   `widop/http-adapter` really optional.

If you don't provide at least one configuration value (regardless the configuration) for the service you use, you must
explicitely enable it in your configuration file:

``` yaml
ivory_google_map:
    geocoder:
        enabled: true
    directions:
        enabled: true
    distance_matrix:
        enabled: true
```

 * The buzz dependencies has been removed in favor of the Wid'op http adapter one. This library allows us to use
   differents http adapter strategies (including buzz).

If you're using Services & Symfony >= 2.1, you need to update your `composer.json` file:

``` json
{
    "require": {
        "egeloen/google-map-bundle": "*",
        "widop/http-adapter-bundle": "1.1.*"
    }
}
```

If you're using Services & Symfony < 2.1, you need to update you `deps` & `app/autoload.php` files:

```
[http-adapter]
    git=http://github.com/widop/http-adapter.git
    version=1.0.2

[http-adapter-bundle]
    git=http://github.com/widop/WidopHttpAdapterBundle.git
    target=bundles/Widop/HttpAdapterBundle
    version=1.1.0
```

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Widop\\HttpAdapter' => __DIR__.'/../vendor/http-adapter/src',
    // ...
);
```

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
