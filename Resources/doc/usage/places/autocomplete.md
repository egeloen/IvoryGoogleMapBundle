# Autocomplete

The Places Autocomplete feature attaches to a text field on your web page, and monitors that field for character
entries. As text is entered, Autocomplete returns Place predictions to the application in the form of a drop-down pick
list. You can use the Places Autocomplete feature to help users find a specific location, or assist them with filling
out address fields in online forms.

It internally uses the [Places Autocomplete](https://github.com/egeloen/ivory-google-map/blob/master/doc/usage/places/autocomplete.md)
of the [Ivory Google Map library](https://github.com/egeloen/ivory-google-map).

## Build your autocomplete

The bundle registers a new form type calles `places_autocomplete` which can be easily configured:

``` php
use Ivory\GoogleMap\Places\AutocompleteType;

$builder->add('field', 'places_autocomplete', array(

    // Javascript prefix variable
    'prefix' => 'js_prefix_',

    // Autocomplete bound (array|Ivory\GoogleMap\Base\Bound)
    'bound'  => $bound,

    // Autocomplete types
    'types'  => array(
        AutocompleteType::CITIES,
        // ...
    ),

    // TRUE if the autocomplete is loaded asynchonously else FALSE
    'async' => false,

    // Autocomplete language
    'language' => 'en',
));
```
