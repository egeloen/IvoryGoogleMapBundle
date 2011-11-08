# Installation

If you use the geocoding API, you need to install Buzz which is a lightweight PHP 5.3 library for issuing HTTP requests.
It is used for requested the Google Map Geocoding API.

## Add respectively Buzz & IvoryGoogleMapBundle to your vendor/ & vendor/bundles/ directories

### Using the vendors script

Add the following lines in your ``deps`` file

```
[buzz]
    git=http://github.com/kriswallsmith/Buzz.git

[IvoryGoogleMapBundle]
    git=http://github.com/egeloen/IvoryGoogleMapBundle.git
    target=/bundles/Ivory/GoogleMapBundle
```

Run the vendors script

    ./bin/vendors update

### Using submodules

``` bash
$ git submodule add http://github.com/kriswallsmith/Buzz.git vendor
$ git submodule add http://github.com/egeloen/IvoryGoogleMapBundle.git vendor/bundles/Ivory/GoogleMapBundle
```

## Add Buzz & Ivory namespaces to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    'Buzz'  => __DIR__.'/../vendor',
    'Ivory' => __DIR__.'/../vendor/bundles',
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
