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
     * @var Ivory\GoogleMapBundle\Model\MarkerImage
     */
    $bound = $this->get('ivory_google_map.marker_image');

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

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Point
     */
    $bound = $this->get('ivory_google_map.point');

::

    /**
     * @var Ivory\GoogleMapBundle\Model\Size
     */
    $bound = $this->get('ivory_google_map.size');

Usage
=====

Map
---

By default, for rendering a map, the bundle uses a center and a zoom.
You can set the map center and the zoom like that:

::

    $map->setCenter($latitude, $longitude);
    $map->setOption('zoom', 10);

If you want the map zooms automatically on the different elements added on it, you just have to enable the auto zoom before you add each objects like that:

::

    $map->setAutoZoom(true);

    // Add your objects
    $map->addMarker($marker);
    $map->addPolyline($polyline);
    ...

If you want the map zooms on specific elements added on it, you need to disable the auto zoom, add your specific element, add your specific element to the map bound extends & enable the autozoom.
In this example, the map will auto zoom on the marker but not on the polyline.

::

    // Disable the auto zoom (By default the auto zoom is disable)
    $map->setAutoZoom(false);

    // Add you element
    $map->addPolyline($polyline)
    $map->addMarker($marker);
    $map->getBound()->extend($marker);

    // Enable the autozoom
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

The icon marker is configuable like that:

::

    $marker->setIcon('icon_url');

::

    $marker->setIcon($markerImage);

The shadow is configurable like that:

::

    $marker->setShadow('shadow_url');

::

    $marker->setShadow($markerImage);

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


Marker image
------------

By default, a marker image has no property. At least, you must specify an image url like that:

::

    $markerImage->setUrl("marker_image_url");

You can set the anchor like that:

::

    $markerImage->setAnchor(x, y);

You can set the origin like that:

::

    $markerImage->setOrigin(x, y);

You can set the size like that:

::

    $markerImage->setSize(width, height);

You can set the scaled size like that:

::

    $markerImage->setScaledSize(width, height);

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
For adding a coordinate to the polygon, you just need to do that:

::

    $polygon->addCoordinate(latitude, longitude);

All the other google map polygon options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#PolygonOptions are configurable like that:

::

    $polygon->setOption('option', 'value');
    $polygon->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a polygon on a map
~~~~~~~~~~~~~~~~~~~~~~

::

    $map->addPolygon($polygon);

Polyline
--------

A polyline, like a polygon, is described by a succession of coordinates.
For adding a coordinate to the polyline, you just need to do that:

::

    $polyline->addCoordinate(latitude, longitude);

All the other google map polyline options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#PolylineOptions are configurable like that:

::

    $polyline->setOption('option', 'value');
    $polyline->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a polyline on a map
~~~~~~~~~~~~~~~~~~~~~~~

::

    $map->addPolyline($polyline);

Ground overlay
--------------

A ground overlay displays a picture which is delimited by a bound. By default, this bound has the following values:

::

    South west:
        latitude: -1
        longitude: -1
    North east:
        latitude: 1
        longitude: 1

You can set this values like that:

::

    $groundOverlay->setBound(south_west_latitude, south_west_longitude, north_east_latitude, north_east_longitude);

For setting the ground overlay, you just need to do that:

::

    $groundOverlay->setUrl('picture_url');

All the other google map ground overlay options available at http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlayOptions are configurable like that:

::

    $groundOverlay->setOption('option', 'value');
    $groundOverlay->setOptions(array(
        'option1' => 'value1',
        'option2' => 'value2'
    ));

Add a ground overlay on a map
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

::

    $map->addGroundOverlay($groundOverlay);

Event manager
-------------

An event manager is just an implementation class which allow you to register events easily.
The explanation below uses ``event`` which is explain in the next section.

Map events
~~~~~~~~~~

To register a google map event which will be trigger all time, you just need to do that:

::

    $map->getEventManager()->addEvent($event);

To register a google map event which will be trigger just one time, you just need to do that:

::

    $map->getEventManager()->addEventOnce($event);

DOM events
~~~~~~~~~~

To register a DOM event which will be trigger all time, you just need to do that:

::

    $map->getEventManager()->addDomEvent($event);

To register a DOM event which will be trigger just one time, you just need to do that:

::

    $map->getEventManager()->addDomEventOnce($event);

Event
-----

Firstly, an event is described by an instance which trigger it.
This instance can be get on any IvoryGoogleMap object which extend ``Ivory\GoogleMapBundle\Model\AbstractAsset`` by calling the ``getJavascriptVariable`` method.
To set this value, you just need to do that:

::

    $event->setInstance('instance');

Secondly, an event is described by an event name which charaterize the event.
All the event name are available at http://code.google.com/apis/maps/documentation/javascript/events.html#UIEvents
To set this value, you just need to do that:

::

    $event->setEventName('event_name');

Thirdly, an event wrap or call a javascript method.
If you want to wrap a javascript method, you just need to define you method like that:

::

    $event->setHandler('function(){ ... }');

If you want to call a specific javascript method already define, you just need to do that:

::

    $event->setHandler('specific_method');

Finnaly, if you use an event like a DOM event, you can set a capture flag like that:

::

    $event->setCapture(true);

Coordinate, Bound, Point & Size
-------------------------------

A coordinate & a bound are basic objects which are wrapped in many other objects.

Coordinate
~~~~~~~~~~

A coordinate is described by a latitude, a longitude & a no wrap boolean.

Bound
~~~~~

A bound is described by two coordinates which describe the south west & the north east.
If the south west & north east coordinates are equal to null, the bound will be rendered without limit and this only usage will be to extend some other google map object.

Point
~~~~~

A point is described by two point in the space (x, y).

Size
~~~~

A size is described by a width & an height. Additionnaly, you can specify a width & height unit.

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
            options:
                option: value

Marker image
------------

::

    # app/config/config.yml
    ivory_google_map:
        marker_image:
            class: Ivory\GoogleMapBundle\Model\MarkerImage
            helper: Ivory\GoogleMapBundle\Templating\Helper\MarkerImageHelper
            prefix_javascript_variable: "marker_image_"
            url: "marker_image_url"

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
            prefix_javascript_variable: "event_"

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

Point
-----

::

    # app/config/config.yml
    ivory_google_map:
        point:
            class: Ivory\GoogleMapBundle\Model\Point
            helper: Ivory\GoogleMapBundle\Templating\Helper\PointHelper
            x: 0
            y: 0

Size
-----

::

    # app/config/config.yml
    ivory_google_map:
        size:
            class: Ivory\GoogleMapBundle\Model\Size
            helper: Ivory\GoogleMapBundle\Templating\Helper\SizeHelper
            width: 0
            height: 0
            width_unit: null
            height_unit: null

Twig
====

Configuration
-------------

By default, the twig extension is activate.
If you want, you can disable it with the following configuration:

::

    ivory_google_map:
        twig:
            enabled: false

Render a map with twig
----------------------

Three twig functions are delivered with the bundle. One for rendering the map container, one for the rendering the map javascripts & one for rendering the map stylesheets.

Map container
~~~~~~~~~~~~~

For rendering the map container, use:

::

    {{ google_map_container(map) }}

This method will render the following HTML:

::

    <div id="map_html_container"></div>

Map javascripts
~~~~~~~~~~~~~~~

For rendering the map javascripts, use:

::

    {{ google_map_js(map) }}

This method will render an HTML javascript block which provides all the map needs to be rendered. This block looks like:

::

    <script type="text/javascript">
        ...
    </script>

Map stylesheets
~~~~~~~~~~~~~~~

For rendering the map stylesheets, use:

::

    {{ google_map_css(map) }}

This method will render an HTML stylesheet block with all the values specified in the ``stylesheetOptions`` of the map. This block looks like:

::

    <style type="text/css">
        ...
    </style>

ORM
===

The bundle is delivered with a full ORM support. All the entities has been pre-configured except for the ID & the association.
You will say : "WHY ?!". Simply because if you would like to just persist a part of the entites, you can.

So, for using ORM support, you need to override each entities you need.

Map
---

Class definition
~~~~~~~~~~~~~~~~

A map needs a coordinate (center) or a bound to be correctly rendering. So you need to persist one or both with the map.
If you want to persist linked events, you need to persist the event manager & the event too.
All the others options are persistable if you need them.

::

    // src/YourBundle/Entity/Map.php
    use Ivory\GoogleMapBundle\Entity\Map as BaseMap;
    use Doctrine\Common\Collections\ArrayCollection;

    class Map extends BaseMap
    {
        /**
         * @var integer Map ID
         */
        protected $id;

        /**
         * Create a map
         */
        public function __construct()
        {
            // Call the parent constructor
            parent::__construct();

            // Link map to a center entity or a bound entity
            $this->center = new Coordinate();
            $this->bound = new Bound();

            // Link map to the event manager entity (Optional)
            $this->eventManager = new EventManager();

            // Initialize the array collection
            $this->markers = new ArrayCollection();
            $this->infoWindows = new ArrayCollection();
            $this->polylines = new ArrayCollection();
            $this->polygons = new ArrayCollection();
            $this->rectangles = new ArrayCollection();
            $this->circles = new ArrayCollection();
            $this->groundOverlays = new ArrayCollection();
        }

        /**
         * Gets the map ID
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Map.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="...\...\Entity\Map">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="center" target-entity="..\..\Entity\Coordinate" />
            <one-to-one field="bound" target-entity="..\..\Entity\Bound" />
            <one-to-one field="eventManager" target-entity="..\..\Entity\EventManager" />
            <many-to-many field="markers" target-entity="..\..\Entity\Marker" />
            <many-to-many field="infoWindows" target-entity="..\..\Entity\InfoWindow" />
            <many-to-many field="polylines" target-entity="..\..\Entity\Polyline" />
            <many-to-many field="polygons" target-entity="..\..\Entity\Polygon" />
            <many-to-many field="rectangles" target-entity="..\..\Entity\Rectangle" />
            <many-to-many field="circles" target-entity="..\..\Entity\Circle" />
            <many-to-many field="groundOverlays" target-entity="..\..\Entity\GroundOverlay" />
        </entity>

    </doctrine-mapping>

Coordinate
----------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Coordinate.php
    use Ivory\GoogleMapBundle\Entity\Coordinate as BaseCoordinate;

    class Coordinate extends BaseCoordinate
    {
        /**
         * @var integer Coordinate ID
         */
        protected $id;

        /**
         * Create a coordinate
         */
        public function __construct($latitude = 0, $longitude = 0, $noWrap = true)
        {
            // Call parent constructor
            parent::__construct($latitude, $longitude, $noWrap);
        }

        /**
         * Gets the coordinate ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Coordinate.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Coordinate">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
        </entity>

    </doctrine-mapping>

Bound
-----

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Bound.php
    use Ivory\GoogleMapBundle\Entity\Bound as BaseBound;

    class Bound extends BaseBound
    {
        /**
         * @var integer Bound ID
         */
        protected $id;

        /**
         * Create a bound
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();
        }

        /**
         * Gets the bound ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Bound.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Bound">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="southWest" target-entity="..\..\Entity\Coordinate" nullable="true" />
            <one-to-one field="northEast" target-entity="..\..\Entity\Coordinate" nullable="true" />
        </entity>

    </doctrine-mapping>

Point
----------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Point.php
    use Ivory\GoogleMapBundle\Entity\Point as BasePoint;

    class Point extends BasePoint
    {
        /**
         * @var integer Point ID
         */
        protected $id;

        /**
         * Create a point
         */
        public function __construct($x = 0, $y = 0)
        {
            // Call parent constructor
            parent::__construct($x, $y);
        }

        /**
         * Gets the point ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Point.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Point">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
        </entity>

    </doctrine-mapping>

Size
----------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Size.php
    use Ivory\GoogleMapBundle\Entity\Size as BaseSize;

    class Size extends BaseSize
    {
        /**
         * @var integer Size ID
         */
        protected $id;

        /**
         * Create a size
         */
        public function __construct($width = 0, $height = 0, $widthUnit = null, $heightUnit = null)
        {
            // Call parent constructor
            parent::__construct($width, $height, $widthUnit, $heightUnit);
        }

        /**
         * Gets the size ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Size.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Size">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
        </entity>

    </doctrine-mapping>

Event manager
-------------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/EventManager.php
    use Ivory\GoogleMapBundle\Entity\EventManager as BaseEventManager;
    use Doctrine\Common\Collections\ArrayCollection;

    class EventManager extends BaseEventManager
    {
        /**
         * @var integer Event manager ID
         */
        protected $id;

        /**
         * Create an event manager
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Initialize the array collection
            $this->domEvents = new ArrayCollection();
            $this->domEventsOnce = new ArrayCollection();
            $this->events = new ArrayCollection();
            $this->eventsOnce = new ArrayCollection();
        }

        /**
         * Gets the event manager ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/EventManager.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\EventManager">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <many-to-many field="domEvents" target-entity="..\..\Entity\Event" />
            <many-to-many field="domEventsOnce" target-entity="..\..\Entity\Event" />
            <many-to-many field="events" target-entity="..\..\Entity\Event" />
            <many-to-many field="eventsOnce" target-entity="..\..\Entity\Event" />
        </entity>

    </doctrine-mapping>

Event
-----

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Event.php
    use Ivory\GoogleMapBundle\Entity\Event as BaseEvent;

    class Event extends BaseEvent
    {
        /**
         * @var integer Event ID
         */
        protected $id;

        /**
         * Create an event
         */
        public function __construct($instance, $eventName, $handle, $capture = false)
        {
            // Call parent constructor
            parent::__construct($instance, $eventName, $handle, $capture);
        }

        /**
         * Gets the event ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Event.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Event">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
        </entity>

    </doctrine-mapping>

Marker
------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Marker.php
    use Ivory\GoogleMapBundle\Entity\Marker as BaseMarker;

    class Marker extends BaseMarker
    {
        /**
         * @var integer Event ID
         */
        protected $id;

        /**
         * Create an marker
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Link marker to a position entity
            $this->position = new Coordinate();

            // Link a marker to an info window entity
            $this->infoWindow = new InfoWindow();
        }

        /**
         * Gets the marker ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Marker.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Marker">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="position" target-entity="..\..\Entity\Coordinate" />
            <one-to-one field="infoWindow" target-entity="..\..\Entity\InfoWindow" />
        </entity>

    </doctrine-mapping>

Marker image
------------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/MarkerImage.php
    use Ivory\GoogleMapBundle\Entity\MarkerImage as BaseMarkerImage;

    class MarkerImage extends BaseMarkerImage
    {
        /**
         * @var integer Marker image ID
         */
        protected $id;

        /**
         * Create a marker image
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();
        }

        /**
         * Gets the marker image ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Marker.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\MarkerImage">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="anchor" target-entity="..\..\Entity\Point" />
            <one-to-one field="origin" target-entity="..\..\Entity\Point" />
            <one-to-one field="size" target-entity="..\..\Entity\Size" />
            <one-to-one field="scaledSize" target-entity="..\..\Entity\Size" />
        </entity>

    </doctrine-mapping>

Info window
-----------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/InfoWindow.php
    use Ivory\GoogleMapBundle\Entity\InfoWindow as BaseInfoWindow;

    class InfoWindow extends BaseInfoWindow
    {
        /**
         * @var integer Info window ID
         */
        protected $id;

        /**
         * Create an info window
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Link info window to a position entity
            $this->position = new Coordinate();
        }

        /**
         * Gets the info window ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/InfoWindow.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\InfoWindow">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="position" target-entity="..\..\Entity\Coordinate" />
        </entity>

    </doctrine-mapping>

Circle
------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Circle.php
    use Ivory\GoogleMapBundle\Entity\Circle as BaseCircle;

    class Circle extends BaseCircle
    {
        /**
         * @var integer Circle ID
         */
        protected $id;

        /**
         * Create an circle
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Link circle to a center entity
            $this->center = new Coordinate();
        }

        /**
         * Gets the circle ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Circle.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Circle">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="center" target-entity="..\..\Entity\Coordinate" />
        </entity>

    </doctrine-mapping>

Rectangle
---------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Rectangle.php
    use Ivory\GoogleMapBundle\Entity\Rectangle as BaseRectangle;

    class Rectangle extends BaseRectangle
    {
        /**
         * @var integer Rectangle ID
         */
        protected $id;

        /**
         * Create an rectangle
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Link rectangle to a bound entity
            $this->bound = new Bound();
        }

        /**
         * Gets the rectangle ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Rectangle.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Rectangle">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="bound" target-entity="..\..\Entity\Bound" />
        </entity>

    </doctrine-mapping>

Polygon
-------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Polygon.php
    use Ivory\GoogleMapBundle\Entity\Polygon as BasePolygon;
    use Doctrine\Common\Collections\ArrayCollection;

    class Polygon extends BasePolygon
    {
        /**
         * @var integer Polygon ID
         */
        protected $id;

        /**
         * Create an polygon
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Initialize the array collection
            $this->coordinates = new ArrayCollection();
        }

        /**
         * Gets the polygon ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Polygon.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Polygon">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <many-to-many field="coordinates" target-entity="..\..\Entity\Coordinate" />
        </entity>

    </doctrine-mapping>

Polyline
--------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/Polyline.php
    use Ivory\GoogleMapBundle\Entity\Polyline as BasePolyline;
    use Doctrine\Common\Collections\ArrayCollection;

    class Polyline extends BasePolyline
    {
        /**
         * @var integer Polyline ID
         */
        protected $id;

        /**
         * Create an polyline
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Initialize the array collection
            $this->coordinates = new ArrayCollection();
        }

        /**
         * Gets the polyline ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/Polyline.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\Polyline">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <many-to-many field="coordinates" target-entity="..\..\Entity\Coordinate" />
        </entity>

    </doctrine-mapping>

Ground overlay
--------------

Class definition
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Entity/GroundOverlay.php
    use Ivory\GoogleMapBundle\Entity\GroundOverlay as BaseGroundOverlay;

    class GroundOverlay extends BaseGroundOverlay
    {
        /**
         * @var integer Ground overlay ID
         */
        protected $id;

        /**
         * Create an ground overlay
         */
        public function __construct()
        {
            // Call parent constructor
            parent::__construct();

            // Link ground overlay to a bound
            $this->bound = new Bound();
        }

        /**
         * Gets the ground overlay ID
         *
         * @return integer
         */
        public function getId()
        {
            return $this->id;
        }
    }

Doctrine mapping
~~~~~~~~~~~~~~~~

::

    // src/YourBundle/Resources/config/doctrine/GroundOverlay.orm.xml
    <doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

        <entity name="..\..\Entity\GroundOverlay">
            <id name="id" type="integer">
                <generator strategy="AUTO" />
            </id>
            <one-to-one field="bound" target-entity="..\..\Entity\Bound" />
        </entity>

    </doctrine-mapping>
