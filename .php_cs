<?php

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;

$finder = DefaultFinder::create()
    ->in([__DIR__])
    ->exclude(['vendor']);

return Config::create()
    ->setUsingCache(true)
    ->fixers([
        'align_double_arrow',
        'short_array_syntax',
        'ordered_use',
        '-psr0',
    ])
    ->finder($finder);
