<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Templating;

use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper as BasePlaceAutocompleteHelper;
use Ivory\GoogleMap\Place\Autocomplete;
use Symfony\Component\Templating\Helper\Helper;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelper extends Helper
{
    /**
     * @var BasePlaceAutocompleteHelper
     */
    private $placeAutocompleteHelper;

    /**
     * @param BasePlaceAutocompleteHelper $placeAutocompleteHelper
     */
    public function __construct(BasePlaceAutocompleteHelper $placeAutocompleteHelper)
    {
        $this->placeAutocompleteHelper = $placeAutocompleteHelper;
    }

    /**
     * @param Autocomplete $autocomplete
     * @param string[]     $attributes
     *
     * @return string
     */
    public function render(Autocomplete $autocomplete, array $attributes = [])
    {
        $autocomplete->addInputAttributes($attributes);

        return $this->placeAutocompleteHelper->render($autocomplete);
    }

    /**
     * @param Autocomplete $autocomplete
     * @param string[]     $attributes
     *
     * @return string
     */
    public function renderHtml(Autocomplete $autocomplete, array $attributes = [])
    {
        $autocomplete->addInputAttributes($attributes);

        return $this->placeAutocompleteHelper->renderHtml($autocomplete);
    }

    /**
     * @param Autocomplete $autocomplete
     *
     * @return string
     */
    public function renderJavascript(Autocomplete $autocomplete)
    {
        return $this->placeAutocompleteHelper->renderJavascript($autocomplete);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_place_autocomplete';
    }
}
