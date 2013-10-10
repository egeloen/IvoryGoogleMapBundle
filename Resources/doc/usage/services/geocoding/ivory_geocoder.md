# Ivory Geocoder

Warning, if you want to use the Ivory Geocoder, you need to use the default configuration or at least, the Ivory
Geocoder & the Ivory Provider.

## Geocode a position

Now you have requested your geocoder, you are able to geocode a position. The bundle allows you to request the google
map geocoding API by two different ways. You have the choice between a simple address (IP or street) or an advanced
geocoder request.

If you want to use it with a business account, you can read this
[documentation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/business_account.md).

### Simple address

``` php
<?php

// Requests the ivory google map geocoder service
$geocoder = $this->get('ivory_google_map.geocoder');

// Geocode an address
$response = $geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
```

### Advanced geocoder request

If you want to build an advanced request, read this specific
[documenation](http://github.com/egeloen/IvoryGoogleMapBundle/blob/master/Resources/doc/usage/services/geocoding/geocoder_request.md).

## Geocoder response

When you have requested your position, the returned object is an ``Ivory\GoogleMap\Services\Geocoding\GeocoderResponse``.
It wraps a geocoder status & geocoder results.

### Geocoder status

The available status are defined by the ``Ivory\GoogleMap\Services\Geocoding\GeocoderStatus`` constants.

``` php
<?php

// Get the geocoder status
$status = $response->getStatus();
```

### Geocoder results

A request can return many results. The geocoder response wraps an array of
``Ivory\GoogleMap\Services\Geocoding\GeocoderResult``.

``` php
<?php

// Get the geocoder results
$results = $reponse->getResults();
```

### Geocoder result

Each result wraps an human readable adress, some address & geometry informations, a partial match flag & some
result types.

#### Human readable address

The method ``getFormattedAddress`` is a string containing the human-readable address of this location.
Often this address is equivalent to the "postal address," which sometimes differs from country to country. (Note that
some countries, such as the United Kingdom, do not allow distribution of true postal addresses due to licensing
restrictions.)

``` php
<?php

// Get the geocoder results
$results = $reponse->getResults();

foreach($results as $result)
    // Get the formatted address
    $address = $result->getFormattedAddress();
```

#### Address informations

The method ``getAddressComponents`` returns an array containing the separate address components. Each address_component
typically contains:

   - types which is an array indicating the type of the address component.
   - long name which is the full text description or name of the address component as returned by the Geocoder.
   - short name which is an abbreviated textual name for the address component, if available. For example, an address
     component for the state of Alaska may have a long_name of "Alaska" and a short_name of "AK" using the 2-letter
     postal abbreviation.

``` php
<?php

// Get the geocoder results
$results = $response->getResults();

foreach($results as $result)
{
    foreach($result->getAddressComponents() as $addressComponent)
    {
        $longName = $addressComponent->getLongName();
        $shortName = $addressComponent->getShortName();
        $types = $addressComponent->getTypes();
    }
}
```

You can filter the address components by type:

``` php
<?php

// Get the geocoder results
$results = $response->getResults();

foreach ($results as $result) {
    foreach ($result->getAddressComponents('route') as $addressComponent) {
        // ...
    }
}

#### Geometry informations

Geometry contains the following information:

   - location which is an ``Ivory\GoogleMap\Base\Coordinate``.
   - location type stores additional data about the specified location. The available possibilites are describes by the
     ``Ivory\GoogleMap\Services\Geocoding\GeocoderLocationType`` constants.
   - viewport which contains the recommended viewport for displaying the returned result, specified as
     ``Ivory\GoogleMap\Base\Bound``.
   - bounds (optionally returned) which stores the bounding box which can fully contain the returned result, specified
     as ``Ivory\GoogleMap\Base\Bound``. Note that these bounds may not match the recommended viewport.

``` php
<?php

// Get the geocoder results
$results = $response->getResults();

foreach($results as $result)
{
    $location = $result->getGeometry()->getLocation()
    $locationType = $result->getGeometry()->getLocationType();
    $viewport = $result->getGeometry()->getViewport();
    $bound = $result->getGeometry()->getBound();
}
```

#### Partial match flag

The partial match flag indicates that the geocoder did not return an exact match for the original request, though it
did match part of the requested address. You may wish to examine the original request for misspellings and/or an
incomplete address. Partial matches most often occur for street addresses that do not exist within the locality you
pass in the request.

``` php
<?php

// Get the geocoder results
$results = $response->getResults();

foreach($results as $result)
    $partialMatch = $result->isPartialMatch();
```

#### Result types

The result types is an array indicates the type of the returned result. This array contains a set of one or more tags
identifying the type of feature returned in the result. For example, a geocode of "Chicago" returns "locality" which
indicates that "Chicago" is a city, and also returns "political" which indicates it is a political entity.

``` php
<?php

// Get the geocoder results
$results = $response->getResults();

foreach($results as $result)
    $types = $result->getTypes();
```

## Create a marker according to a geocoded location

``` php
<?php

// Request the geocoder service
$this->get('ivory_google_map.geocoder');

// Geocode a location
$response = $this->geocode('1600 Amphitheatre Parkway, Mountain View, CA');

// Request the google map service
$map = $this->get('ivory_google_map.map');

foreach($response->getResults() as $result)
{
    // Request the google map merker service
    $marker = $this->get('ivory_google_map.marker');

    // Position the marker
    $marker->setPosition($result->getGeometry()->getLocation());

    // Add the marker to the map
    $map->addMarker($marker);
}
```
