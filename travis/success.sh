#!/usr/bin/env bash

set -e

DOCKER_BUILD=${DOCKER_BUILD-false}
TRAVIS_PHP_VERSION=${TRAVIS_PHP_VERSION-7.0}

if [ "$DOCKER_BUILD" = false ]; then
    wget https://scrutinizer-ci.com/ocular.phar
    php ocular.phar code-coverage:upload --format=php-clover clover.xml
fi
