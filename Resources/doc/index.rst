Provides a google map integration for your Symfony2 Project.

Installation
============

Add IvoryGoogleMapBundle to your vendor/bundles/ directory
----------------------------------------------------------

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
--------------------------------------------------

::

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            // ...
        );
    }

List of available services
==========================

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Map
     */
    $map = $this->get('ivory_google_map.map');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Marker
     */
    $marker = $this->get('ivory_google_map.marker');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\InfoWindow
     */
    $infoWindow = $this->get('ivory_google_map.info_window');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Circle
     */
    $circle = $this->get('ivory_google_map.circle');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Rectangle
     */
    $rectangle = $this->get('ivory_google_map.rectangle');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Polygon
     */
    $polygon = $this->get('ivory_google_map.polygon');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Polyline
     */
    $polyline = $this->get('ivory_google_map.polyline');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\GroundOverlay
     */
    $ground_overlay = $this->get('ivory_google_map.ground_overlay');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\EventManager
     */
    $event_manager = $this->get('ivory_google_map.event_manager');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Event
     */
    $event = $this->get('ivory_google_map.event');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate
     */
    $coordinate = $this->get('ivory_google_map.coordinate');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Bound
     */
    $bound = $this->get('ivory_google_map.bound');

Usage
=====

Map
---

By default, for rendering a map, the bundle uses a center and a zoom.
You can set the map center and the zoom like that:

::

    $map->setCenter($latitude, $longitude);
    $map->setOption('zoom', 10);

If you want the map zooms automatically on the different elements added on it, you just have to enable the auto zoom like that:

::

    $map->setAutoZoom(true);

If you want the map zooms on a bound, you must enable the auto zoom like above and configure the map bound like that:

::

    $map->setAutoZoom(true);
    $map->setBound(south_west_latitude, south_west_longitude, north_east_latitude, north_east_longitude);

All the other google map options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#MapOptions are configurable like that:

::

    $map->setMapOption('option', 'value');
    $map->setMapOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

You can add stylesheet options to the map like that:

::

    $map->setStylesheetOption('option', 'value');
    $map->setStylesheetOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Marker
------

By default, a marker is positionned at the center of the world map (latitude: 0, longitude: 0).
You can set the marker position like that:

::

    $marker->setPosition($latitude, $longitude);

The icon and the shadow marker are configuable like that:

::

    $marker->setIcon('icon_url');
    $marker->setShadow('shadow_url');

All the other google map marker options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerOptions are configurable like that:

::

    $marker->setOption('option', 'value');
    $marker->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a marker to a map
~~~~~~~~~~~~~~~~~~~~~

::

    $map->addMarker($marker);

Info window
-----------

By default, an info window is not positionned and it is open.
The content of an info window is some HTML which is configurable like that:

::

    $infoWindow->setContent('<p>Default content</p>');

If you want the info window is not open when the map is rendering, you just need to set the open property to false:

::

    $infoWindow->setOpen(false);

All the other google map info window options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindowOptions are configurable like that:

::

    $infoWindow->setOption('option', 'value');
    $infoWindow->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add an info window on a map
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you add an info window to a map, you need to position the info window on a map like that:

::

    $infoWindow->setPosition(latitude, longitude);
    $map->addInfoWindow($infoWindow);

Add an info window on a marker
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

    $marker->setInfoWindow($infoWindow);

Circle
------

By default, a circle is potionned at the center of the world map (latitude: 0, longitude: 0) with a radius of 1 meter.
You can set the position of the circle like that:

::

    $circle->setCenter(latitude, longitude);

The radius of the circle can be set like that:

::

    $circle->setRadius(radius);

All the other google map circle options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions are configurable like that:

::

    $circle->setOption('option', 'value');
    $circle->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a circle on a map
~~~~~~~~~~~~~~~~~~~~~

::

    $map->addCircle($circle);

Rectangle
---------

A rectangle is delimited by a bound. By default, this bound has the following values:

::

    South west:
        latitude: -1
        longitude: -1
    North east:
        latitude: 1
        longitude: 1

You can set this values like that:

::

    $rectangle->setBound(south_west_latitude, south_west_longitude, north_east_latitude, north_east_longitude);

All the other google map rectangle options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#RectangleOptions are configurable like that:

::

    $rectangle->setOption('option', 'value');
    $rectangle->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a rectangle on a map
~~~~~~~~~~~~~~~~~~~~~~~~

::

    $map->addRectangle($rectangle);

Polygon
-------

A polygon is described by a succession of coordinates.
For adding a coordinate to the polygon, you just nedd to do that:

::

    $polygon->addCoordinate(latitude, longitude);

All the other google map polygon options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#PolygonOptions are configurable like that:

::

    $polygon->setOption('option', 'value');
    $polygon->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Polyline
--------

Ground overlay
--------------

Event manager
-------------

Event
-----

Coordinate
----------

Bound
-----

Configuration
=============

By default, the bundle doesn't need any configuration.
But, if you wish, it is configurable.

Map
---

::

    # app/config/config.yml
    ivory_google_map:
        map:
            class: "Ivory\GoogleMapBundle\Model\Map"
            helper: "Ivory\GoogleMapBundle\Templating\Helper\MapHelper"
            prefix_javascript_variable: "map_"
            html_container: "map_canvas"
            auto_zoom: false
            center:
                latitude: 0
                longitude: 0
                no_wrap: true
            type: "roadmap"
            zoom: 10
            width: "300px"
            height: "300px"
            map_options:
                option: value
            stylesheet_options:
                option: value

Marker
------

::

    # app/config/config.yml
    ivory_google_map:
        marker:
            class: Ivory\GoogleMapBundle\Model\Marker
            helper: Ivory\GoogleMapBundle\Templating\Helper\MarkerHelper
            prefix_javascript_variable: "marker_"
            position:
                latitude: 0
                longitude: 0
                no_wrap: true
            icon: "icon_url"
            shadow: "shadow_url"
            options:
                option: value

Info window
-----------

::

    # app/config/config.yml
    ivory_google_map:
        info_window:
            class: Ivory\GoogleMapBundle\Model\InfoWindow
            helper: Ivory\GoogleMapBundle\Templating\Helper\InfoWindowHelper
            prefix_javascript_variable: "info_window_"
            position:
                latitude: 0
                longitude: 0
                no_wrap: true
            content: "<p>Default content</p>"
            open: true
            options:
                option: value

Circle
------

::

    # app/config/config.yml
    ivory_google_map:
        circle:
            class: Ivory\GoogleMapBundle\Model\Circle
            helper: Ivory\GoogleMapBundle\Templating\Helper\CircleHelper
            prefix_javascript_variable: "circle_"
            center:
                latitude: 0
                longitude: 0
                no_wrap: true
            radius: 1
            options:
                option: value

Rectangle
---------

::

    # app/config/config.yml
    ivory_google_map:
        rectangle:
            class: Ivory\GoogleMapBundle\Model\Rectangle
            helper: Ivory\GoogleMapBundle\Templating\Helper\RectangleHelper
            prefix_javascript_variable: "rectangle_"
            bound:
                south_west:
                    longitude: 0
                    latitude: 0
                    no_wrap: true
                north_east:
                    longitude: 0
                    latitude: 0
                    no_wrap: true
            options:
                option: value

Polygon
-------

::

    # app/config/config.yml
    ivory_google_map:
        polygon:
            class: Ivory\GoogleMapBundle\Model\Polygon
            helper: Ivory\GoogleMapBundle\Templating\Helper\PolygonHelper
            prefix_javascript_variable: "polygon_"
            options:
                option: value

Polyline
--------

::

    # app/config/config.yml
    ivory_google_map:
        polyline:
            class: Ivory\GoogleMapBundle\Model\Polyline
            helper: Ivory\GoogleMapBundle\Templating\Helper\PolylineHelper
            prefix_javascript_variable: "polyline_"
            options:
                option: value

Ground overlay
--------------

::

    # app/config/config.yml
    ivory_google_map:
        ground_overlay:
            class: Ivory\GoogleMapBundle\Model\GroundOverlay
            helper: Ivory\GoogleMapBundle\Templating\Helper\GroundOverlayHelper
            prefix_javascript_variable: "ground_overlay_"
            bound:
                south_west:
                    longitude: 0
                    latitude: 0
                    no_wrap: true
                north_east:
                    longitude: 0
                    latitude: 0
                    no_wrap: true
            options:
                option: value

Event manager
-------------

::

    # app/config/config.yml
    ivory_google_map:
        event_manager:
            class: Ivory\GoogleMapBundle\Model\EventManager

Event
-----

::

    # app/config/config.yml
    ivory_google_map:
        event:
            class: Ivory\GoogleMapBundle\Model\Event
            helper: Ivory\GoogleMapBundle\Templating\Helper\EventHelper

Coordinate
----------

::

    # app/config/config.yml
    ivory_google_map:
        coordinate:
            class: Ivory\GoogleMapBundle\Model\Coordinate
            helper: Ivory\GoogleMapBundle\Templating\Helper\CoordinateHelper
            latitude: 0
            longitude: 0
            no_wrap: true

Bound
-----

::

    # app/config/config.yml
    ivory_google_map:
        bound:
            class: Ivory\GoogleMapBundle\Model\Bound
            helper: Ivory\GoogleMapBundle\Templating\Helper\BoundHelper
            prefix_javascript_variable: "bound_"
