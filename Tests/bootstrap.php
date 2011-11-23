<?php

system(sprintf('php %s', escapeshellarg(__DIR__.'/bin/vendors')));

require_once __DIR__.'/'.$_SERVER['SYMFONY'].'/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'  => __DIR__.'/'.$_SERVER['SYMFONY'],
    'Buzz'     => __DIR__.'/'.$_SERVER['BUZZ'],
    'Geocoder' => __DIR__.'/'.$_SERVER['GEOCODER'],
    'Ivory'    => __DIR__.'/../../..'
));
$loader->register();
