Provides a google map integration for your Symfony2 Project.

Installation
============

Add IvoryGoogleMapBundle to your vendor/bundles/ directory
-------------------------------------------------------

Using the vendors script
~~~~~~~~~~~~~~~~~~~~~~~~

Add the following lines in your ``deps`` file::

    [IvoryGoogleMapBundle]
        git=http://github.com/egeloen/IvoryGoogleMapBundle.git
        target=/bundles/Ivory/GoogleMapBundle

Run the vendors script::

    ./bin/vendors update

Using submodules
~~~~~~~~~~~~~~~~

::

    $ git submodule add http://github.com/egeloen/IvoryGoogleMapBundle.git vendor/bundles/Ivory/GoogleMapBundle

Add the Ivory namespace to your autoloader
------------------------------------------

::

    // app/autoload.php
    $loader->registerNamespaces(array(
        'Ivory' => __DIR__.'/../vendor/bundles',
        // ...
    );

Add the GoogleMapBundle to your application kernel
-----------------------------------------------

::

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            // ...
        );
    }

Usage
=====

In progress
