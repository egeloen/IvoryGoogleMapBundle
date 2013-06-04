# Usage

Before starting, I recommend you to read the google map API v3 documentation which is available
[here](http://code.google.com/apis/maps/documentation/javascript/reference.html).

## Build your map

``` php
/** @var Ivory\GoogleMapBundle\Model\Map */
$map = $this->get('ivory_google_map.map');
```

The ``ivory_google_map.map`` service is the central point of the bundle. It allows you to manipulate all map options.
If you render the default map, the bundle will generate a map of 300px by 300px, centered on the coordinate (0, 0),
configured with a zoom of 3 & using the default google map controls.

## Configure your map

Now, you have requested your map, you can configure it easily & advancely.

The complete map configuration is available
[here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/map.md).

### Configure overlays

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom
the map. Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of
objects.

 1. [Marker](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/marker.md)
 2. [Info window](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/info_window.md)
 3. [Polyline](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polyline.md)
 4. [Encoded Polyline](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/encoded_polyline.md)
 5. [Polygon](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polygon.md)
 6. [Rectangle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/rectangle.md)
 7. [Circle](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/circle.md)
 8. [Ground overlay](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/overlays/ground_overlay.md)

### Configure controls

The maps on Google Maps contain UI elements for allowing user interaction through the map. These elements are known
as ``controls`` and you can include variations of these controls in your Google Maps API application. Alternatively,
you can do nothing and let the Google Maps API handle all control behavior.

 1. [Map type control](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/map_type.md)
 2. [Overview](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/overview.md)
 3. [Pan](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/pan.md)
 4. [Rotate](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/rotate.md)
 5. [Scale](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/scale.md)
 6. [Street view](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/street_view.md)
 7. [Zoom](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/controls/zoom.md)

### Configure events

The complete events configuration is available
[here](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/events.md).

### Configure additional libraries

Sometimes, you want to use the map & other Google Map related libraries. The bundle provides many integrations but not
all of them. If you need a custom libraries, you can use the following configuration:

```
ivory_google_map:
    api:
        # Your own API helper class
        helper_class: "My\Fucking\ApiHelper"

        # Your additional libraries
        libraries: [ "places", "geometry" ]
```

## Render your map

The google map API needs at least an html container & some javascript for being able to render a map. For rendering
them, the bundle delivered two twig functions : ``google_map_container`` & ``google_map_js``.

Warning, the HTML container needs to be rendered before javascript.

### Render the HTML container

For twig:

```
{{ google_map_container(map) }}
```

For php:

```
$view['ivory_google_map']->renderHtmlContainer($map);
```

This function renders an html div block with the HTML container ID, the width & the height configured.

``` html
<div id="map_canvas" style="width:300px;height:300px"></div>
```

### Render the javascript

For twig:

```
{{ google_map_js(map) }}
```

For php:

```
$view['ivory_google_map']->renderJavascripts($map);
```

This function renders an html javascript block with all code needed for displaying your map.

``` html
<script type="text/javascript">
    // Code needed for displaying your map
</script>
```

### Render the CSS (Optional)

Additionally, you can configure some CSS directly on the map. For rendering it, use the twig function :
``google_map_css``.

For twig:

```
{{ google_map_css(map) }}
```

For php:

```
$view['ivory_google_map']->renderStylesheets($map);
```

This function renders an html style block with the CSS configured.

``` html
<style type="text/css">
    /* CSS configured */
</style>
```
