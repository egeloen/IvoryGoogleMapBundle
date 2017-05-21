<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

if (isset($_ENV['COMPOSER_PREFER_LOWEST']) && $_ENV['COMPOSER_PREFER_LOWEST'] === 'true') {
    $_SERVER['API_KEY'] = 'AIzaSyDKaDeZ6PvKb3RqgIaFeKSSdVRtLc9jM1I';
    $_SERVER['API_SECRET'] = 'zKAvb7nwW1TnJZtfXWC9Y_uUDU4';
}

require_once __DIR__.'/../vendor/autoload.php';

\PHPUnit_Extensions_Selenium2TestCase::shareSession(true);
