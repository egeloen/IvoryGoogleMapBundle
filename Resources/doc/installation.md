# Installation

## Symfony 2.1.*

Require the bundle in your composer.json file:

```
{
    "require": {
        "egeloen/google-map-bundle": "*",
    }
}
```

If you want to use Geocoding stuff, you will need [Geocoder](http://github.com/willdurand/Geocoder):

```
{
    "require": {
        "willdurand/geocoder": "*"
    }
}
```

If you want to use Directions stuff, you will need [Buzz](http://github.com/kriswallsmith/Buzz):

```
{
    "require": {
        "kriswallsmith/buzz": "*"
    }
}
```

Register the bundle:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
        // ...
    );
}
```

Install the bundle:

```
$ composer update
```

## Symfony 2.0.*

Add Ivory Google Map bundle & library to your deps file:

```
[IvoryGoogleMapBundle]
    git=http://github.com/egeloen/IvoryGoogleMapBundle.git
    target=bundles/Ivory/GoogleMapBundle
    version=1.0.0

[ivory-google-map]
    git=http://github.com/egeloen/ivory-google-map.git
```

Autoload the Ivory Google Map bundle & library namespaces:

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Ivory\\GoogleMap'       => __DIR__.'/../vendor/ivory-google-map/src',
    'Ivory\\GoogleMapBundle' => __DIR__.'/../vendor/bundles',
    // ...
);
```

If you want to use Geocoding stuff, you will need [Geocoder](http://github.com/willdurand/Geocoder):

```
[geocoder]
    git=http://github.com/willdurand/Geocoder.git
```

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Geocoder' => __DIR__.'/../vendor/geocoder/src',
    // ...
);
```

If you want to use Directions stuff, you will need [Buzz](http://github.com/kriswallsmith/Buzz):

```
[buzz]
    git=http://github.com/kriswallsmith/Buzz.git
```

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Buzz' => __DIR__.'/../vendor/buzz/src',
    // ...
);
```

Register the bundle:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
        // ...
    );
}
```

Run the vendors script:

``` bash
$ php bin/vendors install
```
