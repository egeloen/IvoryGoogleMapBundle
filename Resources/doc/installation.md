# Installation

If you use the geocoding API, you need to install [Geocoder](http://github.com/willdurand/Geocoder.git) which is a PHP 5.3 library for issuing Geocoding and his dependencies ([Buzz](https://github.com/kriswallsmith/Buzz) or other adapters).

## Add respectively Buzz|Geocoder & IvoryGoogleMapBundle to your vendor/ & vendor/bundles/ directories

### Using the vendors script

Add the following lines in your ``deps`` file

```
[buzz]
    git=http://github.com/kriswallsmith/Buzz.git

[geocoder]
    git=http://github.com/willdurand/Geocoder.git

[IvoryGoogleMapBundle]
    git=http://github.com/egeloen/IvoryGoogleMapBundle.git
    target=/bundles/Ivory/GoogleMapBundle
```

Run the vendors script

    ./bin/vendors update

### Using submodules

``` bash
$ git submodule add http://github.com/kriswallsmith/Buzz.git vendor
$ git submodule add http://github.com/willdurand/Geocoder.git vendor
$ git submodule add http://github.com/egeloen/IvoryGoogleMapBundle.git vendor/bundles/Ivory/GoogleMapBundle
```

## Add Buzz, Geocoder & Ivory namespaces to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    'Buzz'     => __DIR__.'/../vendor/buzz/lib',
    'Geocoder' => __DIR__.'/../vendor/geocoder/src',
    'Ivory'    => __DIR__.'/../vendor/bundles',
    // ...
);
```

## Add the IvoryGoogleMapBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
        // ...
    );
}
```

Next: [Usage](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage.md)
