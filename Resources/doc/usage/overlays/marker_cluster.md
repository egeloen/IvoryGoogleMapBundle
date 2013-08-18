# Marker Cluster

Some applications are required to display a large number of locations or markers. Despite the v3 JavaScript API's
significant improvement to performance, naively plotting thousands of markers on a map can quickly lead to to a
degraded user experience. Too many markers on the map cause both visual overload and sluggish interaction with the map.
To overcome this poor performance, the information displayed on the map needs to be simplified, we need a marker
clustering solution.

## Build your marker

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.marker_cluster`` service is. The configuration
describes below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    marker_cluster:
        # Your own marker cluster class
        class: "My\Fucking\MarkerCluster"

        # Your own marker cluster helper class
        helper_class: "My\Fucking\MarkerClusterHelper"

        # Prefix used for the generation of the marker cluster javascript variable
        prefix_javascript_variable: "marker_cluster_"

        # Marker cluster type
        type: "default"

        # Custom marker cluster options
        # By default there is no marker cluster options
        options:
            option: "value"
```

``` php
<?php

// Requests the ivory google map marker cluster service
$markerCluster = $this->get('ivory_google_map.marker_cluster');
```

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/overlays/marker_cluster.md).
```
