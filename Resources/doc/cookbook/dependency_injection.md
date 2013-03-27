# Dependency Injection

The main purpose of the bundle is to build new objects (map, marker, ...) through the Symfony2 DI container. In order
to give you a new object each time you request it on the container, all services have been scoped "prototype". Doing
that, configure the container to always return a new instances when we request it. Pretty cool :)

Anyway, this has a big drawback. Now, all these services can not be injected in a "normal" service (scoped "container").
That's a DI security as it can not guarantee the objects integrity & will result to the following exception:

```
ScopeCrossingInjectionException: Scope Crossing Injection detected: The definition "your.service" references the
service "ivory_google_map.map" which belongs to another scope hierarchy. This service might not be available
consistently. Generally, it is safer to either move the definition "your.service" to scope "prototype", or declare
"container" as a child scope of "prototype". If you can be sure that the other scope is always active, you can set the
reference to strict=false to get rid of this error.
```

Don't worry, the bundle has been designed to solve this issue. Instead of injecting the `ivory_google_map.map` service,
you need to inject the `ivory_google_map.map.builder` which lives in the "container" scope. This service is responsible
to build a new map instance & is used by the container when you request a map. All services scoped "prototype" has been
designed like the map one.
