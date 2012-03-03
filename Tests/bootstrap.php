<?php

system(sprintf('php %s', escapeshellarg(__DIR__.'/bin/vendors')));

require_once __DIR__.'/'.$_SERVER['SYMFONY'].'/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'  => __DIR__.'/'.$_SERVER['SYMFONY'],
    'Buzz'     => __DIR__.'/'.$_SERVER['BUZZ'],
    'Geocoder' => __DIR__.'/'.$_SERVER['GEOCODER']
));
$loader->register();

spl_autoload_register(function($class)
{
    if(strpos($class, 'Ivory\\GoogleMapBundle\\') === 0)
    {
        $path = __DIR__.'/../'.implode('/', array_slice(explode('\\', $class), 2)).'.php';

        if(!stream_resolve_include_path($path))
            return false;

        require_once $path;
        return true;
    }
});
