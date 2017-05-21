# Place Autocomplete

If you want to use the place autocomplete feature in your Symfony project, the easiest way is to rely on the built-in 
for type shipped with the bundle.

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class);
```

The form type supports options which allows you to configure the places autocomplete.

## Configure variable

A variable is automatically generated when creating an autocomplete but if you want to update it, you can use:

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'variable' => 'place_autocomplete',
]);
```

## Configure components

If you want to restrict the autocomplete to components, you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteComponentType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'components' => [AutocompleteComponentType::COUNTRY => 'fr'],
]);
```

## Configure bound

If you want to restrict the search area, you can configure a bound: 

``` php
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'bound' => new Bound(
        new Coordinate(-2.1, -3.9), 
        new Coordinate(2.6, 1.4)
    ),
]);
```

## Configure events

Javascript within the browser is event driven, meaning that Javascript responds to interactions by generating events, 
and expects a program to listen to interesting events.

Before reading this part of the documentation, you should familiarize yourself with the [Event](https://github.com/egeloen/ivory-google-map/blob/master/doc/event.md).

### Dom events

If you want to attach dom events to your place autocomplete:

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'dom_events' => [$event],
]);
```

### Dom events once

If you want to attach dom events once to your place autocomplete:

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'dom_events_once' => [$event],
]);
```

### Events

If you want to attach events to your place autocomplete:

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'events' => [$event],
]);
```

### Events once

If you want to attach events once to your place autocomplete:

``` php
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'events_once' => [$event],
]);
```

## Configure types

If you want to restrict places types, you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'types' => PlaceAutocompleteType::ESTABLISMENT,
]);
```

## Configure libraries

Sometimes, you want to use the autocomplete & other Google Map related libraries. The library provides many 
integrations but not all of them. If you need a custom library (for example `drawing`), you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder->add('field', PlaceAutocompleteType::class, [
    'libraries' => ['drawing'],
]);
```

## Configure api

In order to make everything automatic, the bundle automatically renders the Google API loading when rendering a place 
autocomplete. If you want to disable this behavior, you can use:

``` php
use Ivory\GoogleMap\Place\AutocompleteType;
use Ivory\GoogleMapBundle\Form\Type\PlaceAutocompleteType;

$builder
    ->add('field1', PlaceAutocompleteType::class, [
        'api' => false,
    ])
    ->add('field2', PlaceAutocompleteType::class, [
        'api' => false,
    ]);
```

Disabling the API loading is also very useful if you want to render multiple autocompletes since the API loading can 
only be triggered once. In order to load it once, you can use the following:

``` twig
{% block javascripts %}
    {{ parent() }}
    {{ ivory_google_api([
        form.field1.vars['autocomplete'], 
        form.field2.vars['autocomplete']
    ]) }}
{% endblock %}
```
