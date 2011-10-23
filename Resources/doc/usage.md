# Usage

Before starting, I recommend you to read the google map API v3 documentation which is available [here](http://code.google.com/apis/maps/documentation/javascript/reference.html).

## Build your map

``` php
<?php

/**
 * Requests the ivory google map service
 *
 * @var Ivory\GoogleMapBundle\Model\Map $map
 */
$map = $this->get('ivory_google_map.map');
```

## Configure your map

Now, you have requested your map, you can configure it easily & advancely.

The complete map configuration is available [here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/map.md).

### Configure controls

The maps on Google Maps contain UI elements for allowing user interaction through the map. 
These elements are known as ``controls`` and you can include variations of these controls in your Google Maps API application. 
Alternatively, you can do nothing and let the Google Maps API handle all control behavior.

    1. [Map type control](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/map_type.md)

        The map type control lets the user toggle between map types (such as ROADMAP and SATELLITE). 
        This control appears by default in the top right corner of the map.

    2. [Overview](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/overview.md)

        The overview map control displays a thumbnail overview map reflecting the current map viewport within a wider area. 
        This control appears by default in the bottom right corner of the map, and is by default shown in its collapsed state.

    3. [Pan](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/pan.md)

        The pan control displays buttons for panning the map. 
        This control appears by default in the top left corner of the map on non-touch devices. 
        The Pan control also allows you to rotate 45° imagery, if available.

    4. [Rotate](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/rotate.md)

        The rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. 
        This control appears by default in the top left corner of the map.

    5. [Scale](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/scale.md)

        The scale control displays a map scale element. 
        This control is not enabled by default.

    6. [Street view](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/street_view.md)

        The street view control contains a Pegman icon which can be dragged onto the map to enable street view. 
        This control appears by default in the top left corner of the map.

    7. [Zoom](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/zoom.md)

        The zoom control displays a slider (for large maps) or small "+/-" buttons (for small maps) to control the zoom level of the map. 
        This control appears by default in the top left corner of the map on non-touch devices or in the bottom left corner on touch devices.

### Configure overlays

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom the map. 
Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of objects.

    1. [Marker](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker.md)
    4. [Info window](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/info_window.md)
    5. [Polyline](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polyline.md)
    6. [Polygon](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polygon.md)
    7. [Rectangle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/rectangle.md)
    8. [Circle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/circle.md)
    9. [Ground overlay](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/ground_overlay.md)

### Configure events

JavaScript within the browser is event driven, meaning that JavaScript responds to interactions by generating events, and expects a program to listen to interesting events. 
There are two types of events:
    - User events (such as "click" mouse events) are propagated from the DOM to the Google Maps API. These events are separate and distinct from standard DOM events.
    - MVC state change notifications reflect changes in Maps API objects and are named using a property_changed convention

The complete events configuration is available [here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/events.md).

## Render your map

The google map API needs at least an html container & some javascript for being able to render a map. 
For rendering them, the bundle delivered two twig functions : ``google_map_container`` & ``google_map_js``.

### Render the HTML container

```
{{ google_map_container(map) }}
```

This function renders an html div block with the HTML container ID configured.

``` html
<div id="map_canvas" style="width:300px;height:300px"></div>
```

### Render the javascript

```
{{ google_map_js(map) }}
```

This function renders an html javascript block with all code needed for displaying your map.

``` html
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

### Render the CSS (Optional)

Additionally, you can configure some CSS directly on the map. For rendering it, use the twig function : ``google_map_css``.

```
{{ google_map_css(map) }}
```

This function renders an html style block with the CSS configured.

``` html
<style type="text/css">
    /* CSS configured */
</style>
```

Previous: [Installation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/installation.md)
Next: [Test](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/test.md)
        