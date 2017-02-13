# Installation

To install the Ivory Google Map bundle, you will need [Composer](http://getcomposer.org).  It's a PHP 5.3+ dependency 
manager which allows you to declare the dependent libraries your project needs and it will install & autoload them for 
you.

## Set up Composer

Composer comes with a simple phar file. To easily access it from anywhere on your system, you can execute:

``` bash
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

## Download the bundle

Require the library in your `composer.json` file:

``` bash
$ composer require egeloen/google-map-bundle
```

## Download additional libraries

If you want to use the [Direction](/Resources/doc/service/direction.md), 
[Distance Matrix](/Resources//doc/service/distance_matrix.md), [Elevation](/Resources/doc/service/elevation.md), 
[Geocoder](/Resources//doc/service/geocoder.md), [Place](/Resources//doc/service/place.md) or 
[Time Zone](/Resources/doc/service/time_zone.md) services, you will need an http client and message factory via 
[Httplug](http://httplug.io/) which is an http client abstraction library as well as the 
[Ivory Serializer](https://github.com/egeloen/ivory-serializer) which is an advanced (de)-serialization library. 

[Httplug](http://httplug.io/) and [Ivory Serializer](https://github.com/egeloen/ivory-serializer) provide bundles, so 
let's install them to ease our life:

``` bash
$ composer require egeloen/serializer-bundle
$ composer require php-http/httplug-bundle
$ composer require php-http/guzzle6-adapter
```

Here, I have chosen to use [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) but since Httplug supports the 
most popular http clients, you can install your preferred one instead.

## Register the bundle

Then, add the bundle in your `AppKernel`:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return [
        // ...
        new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
        
        // Optionally
        new Ivory\SerializerBundle\IvorySerializerBundle(),
        new Http\HttplugBundle\HttplugBundle(),
    ];
}
```
