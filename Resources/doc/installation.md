# Installation

## Add IvoryGoogleMapBundle to your vendor/bundles/ directory

### Using the vendors script

Add the following lines in your ``deps`` file

```
[IvoryGoogleMapBundle]
    git=http://github.com/egeloen/IvoryGoogleMapBundle.git
    target=/bundles/Ivory/GoogleMapBundle
```

Run the vendors script

    ./bin/vendors update

### Using submodules

``` bash
$ git submodule add http://github.com/egeloen/IvoryGoogleMapBundle.git vendor/bundles/Ivory/GoogleMapBundle
```

## Add the Ivory namespace to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
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
