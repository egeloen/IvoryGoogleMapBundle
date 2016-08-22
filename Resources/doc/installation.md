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

If you want to use the Geocoder service, you will need [Geocoder](http://github.com/willdurand/Geocoder):

``` bash
$ composer require willdurand/geocoder
```

If you want to use the [Direction](/doc/service/direction/direction.md), 
[Distance Matrix](/doc/service/geocoder/distance-matrix.md) or 
[Geocoder](/doc/service/geocoder/geocoder.md) services, you will need an http client and message factory via 
[Httplug](http://httplug.io/) which is an http client abstraction library. It also provides a bundle, so let's install 
it to ease our life:

``` bash
$ composer require php-http/guzzle6-adapter
$ composer require php-http/message
```

Here, I have chosen to use [Guzzle6](http://docs.guzzlephp.org/en/latest/psr7.html) but since Httplug supports the 
most popular http clients, you can install your preferred one instead.

## Register the bundle

Add the bundle in your `AppKernel`:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return [
        // ...
        new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
        
        // Optionally
        new Http\HttplugBundle\HttplugBundle(),
    ];
}
```
