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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
    public function buildForm(FormBuilderInterface $builder, array $options)
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
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');
        $autocomplete->setInputId($view->vars['id']);
        $autocomplete->setValue($view->vars['value']);
        $autocomplete->setInputAttribute('name', $view->vars['full_name']);

        $view->vars['html'] = $this->getAutocompleteHelper()->renderHtmlContainer($autocomplete);
        $view->vars['javascripts'] = $this->getAutocompleteHelper()->renderJavascripts($autocomplete);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'prefix'   => null,
            'bound'    => null,
            'types'    => array(),
            'async'    => false,
            'language' => $this->getRequest()->getLocale(),
        ));

        $resolver->setAllowedTypes(array(
            'prefix'   => array('string', 'null'),
            'bound'    => array('Ivory\GoogleMap\Base\Bound', 'array', 'null'),
            'types'    => array('array'),
            'async'    => array('bool'),
            'language' => array('string'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'places_autocomplete';
    }
}
