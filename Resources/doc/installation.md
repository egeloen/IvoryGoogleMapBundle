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

Add Ivory Google Map bundle to your deps file:

```
[IvoryGoogleMapBundle]
    git=http://github.com/egeloen/IvoryGoogleMapBundle.git
    target=bundles/Ivory/GoogleMapBundle
    version=1.0.0
```

Autoload the Ivory Google Map bundle namespaces:

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Ivory\\GoogleMapBundle' => __DIR__.'/../vendor/bundles',
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
