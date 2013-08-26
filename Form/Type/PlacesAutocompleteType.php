<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Form\Type;

use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;
use Ivory\GoogleMap\Places\Autocomplete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

/**
 * Google Map places autocomplete type.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteType extends AbstractType
{
    /** @var \Ivory\GoogleMap\Helper\Places\AutocompleteHelper */
    protected $autocompleteHelper;

    /** @var \Symfony\Component\HttpFoundation\Request */
    protected $request;

    /**
     * Creates a places autocomplete form type.
     *
     * @param \Ivory\GoogleMap\Helper\Places\AutocompleteHelper $autocompleteHelper The autocomplete helper.
     * @param \Ivory\GoogleMapBundle\Form\Type\Request          $request            The http request.
     */
    public function __construct(AutocompleteHelper $autocompleteHelper, Request $request)
    {
        $this->setAutocompleteHelper($autocompleteHelper);
        $this->setRequest($request);
    }

    /**
     * Gets the autocomplete helper.
     *
     * @return \Ivory\GoogleMap\Helper\Places\AutocompleteHelper The autocomplete helper.
     */
    public function getAutocompleteHelper()
    {
        return $this->autocompleteHelper;
    }

    /**
     * Sets the autocomplete helper.
     *
     * @param \Ivory\GoogleMap\Helper\Places\AutocompleteHelper $autocompleteHelper The autocomplete helper.
     */
    public function setAutocompleteHelper(AutocompleteHelper $autocompleteHelper)
    {
        $this->autocompleteHelper = $autocompleteHelper;
    }

    /**
     * Gets the http request.
     *
     * @return \Symfony\Component\HttpFoundation\Request The http request.
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the http request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The http request.
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $autocomplete = new Autocomplete();

        if ($options['prefix'] !== null) {
            $autocomplete->setPrefixJavascriptVariable($options['prefix']);
        }

        if ($options['bound'] !== null) {
            if (is_array($options['bound'])) {
                call_user_func_array(array($autocomplete, 'setBound'), $options['bound']);
            } else {
                $autocomplete->setBound($options['bound']);
            }
        }

        if (!empty($options['types'])) {
            $autocomplete->setTypes($options['types']);
        }

        if ($options['attr']) {
            foreach ($options['attr'] as $name => $value) {
                $autocomplete->setInputAttribute($name, $value);
            }
        }

        $autocomplete->setAsync($options['async']);
        $autocomplete->setLanguage($options['language']);

        $builder->setAttribute('autocomplete', $autocomplete);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form)
    {
        $autocomplete = $form->getAttribute('autocomplete');
        $autocomplete->setInputId($view->get('id'));
        $autocomplete->setValue($view->get('value'));
        $autocomplete->setInputAttribute('name', $view->vars['full_name']);

        $view->set('html', $this->getAutocompleteHelper()->renderHtmlContainer($autocomplete));
        $view->set('javascripts', $this->getAutocompleteHelper()->renderJavascripts($autocomplete));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
        return array_merge($options, array(
            'prefix'   => null,
            'bound'    => null,
            'types'    => array(),
            'async'    => false,
            'language' => $this->getRequest()->getLocale(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'places_autocomplete';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(array $options)
    {
        return 'text';
    }    
}
