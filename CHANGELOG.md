# CHANGELOG

### 3.0.1 (2017-05-27)

 * f3fc045 - Remove deprecations triggered with Symfony 3.3
 * 7bf61dd - [Tests] Rely on the new library cache system
 * 3410476 - [Doc] Fix place auutocomplete components restriction example

### 3.0.0 (2017-02-27)

 * b7cd248 - [Composer] Rely on stable versions
 * e136bdc - [Helper] Add static map support 
 * 9452d96 - Add AppVeyor support
 * 1c0bb34 - [Overlay] Add symbol support
 * 4a3249e - [Service] Add Place support
 * 5896f97 - [Docker] Add HHVM container
 * 4a2dbe8 - [Docker] Rely directly on the selenium image
 * f113779 - [Git] Fix gitattributes
 * e79c4b6 - Add docker support
 * 3efa819 - [Composer] Upgrade friendsofphp/php-cs-fixer to 2.x
 * dd1c427 - [README] Add note about doc versions
 * 11b86cb - [Composer] Upgrade deps
 * fd7bba1 - [Scrutinizer] Add configuration file
 * f6182ff - [Gitignore] Reorganize by section
 * 1f37fed - Add .gitattributes file
 * 8c277d9 - Add CONTRIBUTING file
 * abbe3c7 - [License] Happy new year
 * 9367774 - [Doc] Render multiple place autocompletes
 * da0ef82 - Fix info window auto open rendering
 * b664856 - Updated link that wasn't working properly
 * 4324386 - [Service] Use the same parser for all services
 * 5f88711 - [Service] Add suffix to all services
 * fc8cc98 - [Doc] Drop 'willdurand/geocoder' dependency
 * 85866db - [Direction] Fix according to last egeloen/google-map changes
 * 19855f7 - Change bad place autocomplete widget name
 * c078775 - [Service] Add elevation support
 * 5bd545f - [Map] Add custom/fullscreen control support
 * 9587e91 - [Layer] Add auto-zoom support
 * 4b0f67f - [Layer] Add heatmap support
 * b049e76 - [PlaceAutocomplete] Fix template attributes handling
 * 50b3f13 - [Form] Fix place autocomplete resources
 * 2ab3cb1 - [3.0] Sync with egeloen/google-map library
 * 6e49219 - Update installation.md
 
### 2.2.1 (2014-10-30)

 * bd82776 - [Composer] Refine deps
 * 47fbb10 - Rename MarkerImage.xml to MarkerImage.orm.xml
 * 03b0110 - [Composer] Upgrade to PSR-4

### 2.2.0 (2014-06-17)

 * 2599efe - [Travis] Add Symfony 2.5 + Remove 2.0 branch
 * bf48170 - Replace deprecated twig features + Fix PHPDoc + Bump phpunit to ~4.0 + Bump twig to ~1.12
 * fdffec8 - Add coveralls support
 * b2569ba - Fix Geocoder provider documentation
 * c2d25a7 - [Helper] Allow to render the map in a single call
 * d69152a - [Places] Add component restrictions support
 * e6cf9ce - Update new year
 * 69e8426 - Deprecate Symfony 2.0

### 2.0.3 - 2.1.3 (2013-12-12)

 * 2ffb7cd - [Travis] Simplify matrix + Add Symfony 2.4 to the build
 * 1c161c6 - Make widop/http-adapter-bundle really optional
 * df9d815 - [Service] Add business account support
 * 0512906 - [Service] Replace kriswallsmith/buzz by widop/http-adapter

### 2.0.2 - 2.1.2 (2013-10-09)

 * 01d5583 - Add info box support
 * a871d55 - [PlacesAutocompleteType] Fix missing name html attribute + use text as parent type

### 2.0.1 - 2.1.1 (2013-08-22)

 * 034e312 - [Overlays] Add marker cluster support
 * fe226ae - Add Places autocomplete support
 * a619815 - Fix PHP template service by making it public

### 2.0.0 (2013-06-07)

 * db9c9c2 - Add Distance Matrix support
 * b151380 - Add PHP template support
 * d22d5d3 - [Travis] Use --prefer-source to avoid random build fail
 * 83d85e3 - [DI] Use Extension processConfiguration method

### 1.1.1 (2013-04-10)

 * c662180 - [Helper] Add JS container
 * 54ac124 - PSR2 compatibility
 * df4265d - Refactor according to helper renaming

### 1.1.0 (2012-03-13)

 * 2c13c5b - Remove prototyped services
 * 76b0a46 - [Geocoder][Request] Add language support
 * bbf251f - Allow to override all business classes & helpers
 * f82a0d4 - [Directions] Add language parameter to the request
 * a02d698 - [EventListener] Fix fake request listener registration
 * de0c9e6 - [Tests] Fix code coverage
 * 86b9ad3 - [Entity] Fix map pre persist
 * 4c7674d - Extract business class + Fix CS

### 1.0.0 (2012-04-25)
