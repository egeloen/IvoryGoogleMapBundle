# Events

JavaScript within the browser is event driven, meaning that JavaScript responds to interactions by generating events,
and expects a program to listen to interesting events. The event model for the Google Maps API V3 is similar to that
used in V2 of the API, though much has changed under the hood. There are two types of events:

 - User events (such as "click" mouse events) are propagated from the DOM to the Google Maps API. These events are
   separate and distinct from standard DOM events.
 - MVC state change notifications reflect changes in Maps API objects and are named using a property_changed
   convention.

## Build your event

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``ivory_google_map.event`` service is. The configuration describes
below is this default configuration.

```
# app/config/config.yml

ivory_google_map:
    event:
        # You own event class
        class: "My\Fucking\Event"

        # Your own event helper class
        helper_class: "My\Fucking\EventHelper"

        # Prefix used for the generation of the event javascript variable
        prefix_javascript_variable: "event_"

    event_manager:
        # You own event manager class
        class: "My\Fucking\EventManager"

        # Your own event manager helper class
        helper_class: "My\Fucking\EventManagerHelper"
```

``` php
<?php

// Requests the ivory google map event service
$event = $this->get('ivory_google_map.event');
```

The configuration file allows you to manage the generated javascript variable.
All the other configuration can only be done by coding.

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/events.md).
