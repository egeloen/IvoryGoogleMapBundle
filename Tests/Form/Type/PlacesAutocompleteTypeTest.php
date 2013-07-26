<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Form\Type;

use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\GoogleMapBundle\Form\Type\PlacesAutocompleteType;
use Symfony\Component\Form\Forms;

/**
 * Places autocomplete type test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlacesAutocompleteTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Symfony\Component\Form\FormFactoryInterface */
    protected $factory;

    /** @var \Ivory\GoogleMapBundle\Form\Type\PlacesAutocompleteType */
    protected $placesAutocompleteType;

    /** @var \Ivory\GoogleMap\Helper\Places\AutocompleteHelper */
    protected $placesAutocompleteHelperMock;

    /** @var \Symfony\Component\HttpFoundation\Request */
    protected $requestMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->placesAutocompleteHelperMock = $this->getMockBuilder('Ivory\GoogleMap\Helper\Places\AutocompleteHelper')
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $this->requestMock
            ->expects($this->any())
            ->method('getLocale')
            ->will($this->returnValue('en'));

        $this->placesAutocompleteType = new PlacesAutocompleteType(
            $this->placesAutocompleteHelperMock,
            $this->requestMock
        );

        $this->factory = Forms::createFormFactoryBuilder()
            ->addType($this->placesAutocompleteType)
            ->getFormFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->requestMock);
        unset($this->placesAutocompleteHelperMock);
        unset($this->placesAutocompleteType);
        unset($this->factory);
    }

    public function testInitialState()
    {
        $this->assertSame($this->placesAutocompleteHelperMock, $this->placesAutocompleteType->getAutocompleteHelper());
        $this->assertSame($this->requestMock, $this->placesAutocompleteType->getRequest());
    }

    public function testEmptyConfig()
    {
        $form = $this->factory->create('places_autocomplete');
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame('place_autocomplete_', substr($autocomplete->getJavascriptVariable(), 0, 19));
        $this->assertNull($autocomplete->getBound());
        $this->assertFalse($autocomplete->isAsync());
        $this->assertSame('en', $autocomplete->getLanguage());
        $this->assertSame(array('type' => 'text', 'placeholder' => 'off'), $autocomplete->getInputAttributes());
    }

    public function testPrefixConfig()
    {
        $form = $this->factory->create('places_autocomplete', null, array('prefix' => 'foo'));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame('foo', substr($autocomplete->getJavascriptVariable(), 0, 3));
    }

    public function testBoundConfigWithBound()
    {
        $boundMock = $this->getMock('Ivory\GoogleMap\Base\Bound');

        $form = $this->factory->create('places_autocomplete', null, array('bound' => $boundMock));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame($boundMock, $autocomplete->getBound());
    }

    public function testBoundConfigWithArray()
    {
        $form = $this->factory->create(
            'places_autocomplete',
            null,
            array('bound' => array(1.1, 2.1, 3.1, 4.1, true, false))
        );

        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame(1.1, $autocomplete->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2.1, $autocomplete->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($autocomplete->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3.1, $autocomplete->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4.1, $autocomplete->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($autocomplete->getBound()->getNorthEast()->isNoWrap());
    }

    public function testTypesConfig()
    {
        $form = $this->factory->create('places_autocomplete', null, array('types' => array(AutocompleteType::CITIES)));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame(array(AutocompleteType::CITIES), $autocomplete->getTypes());
    }

    public function testAsyncConfig()
    {
        $form = $this->factory->create('places_autocomplete', null, array('async' => true));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertTrue($autocomplete->isAsync());
    }

    public function testLanguageConfig()
    {
        $form = $this->factory->create('places_autocomplete', null, array('language' => 'fr'));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame('fr', $autocomplete->getLanguage());
    }

    public function testInputAttributesConfig()
    {
        $form = $this->factory->create('places_autocomplete', null, array('attr' => array('foo' => 'bar')));
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame(
            array('type' => 'text', 'placeholder' => 'off', 'foo' => 'bar'),
            $autocomplete->getInputAttributes()
        );
    }

    public function testInputId()
    {
        $form = $this->factory->create('places_autocomplete');
        $form->createView();

        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame('places_autocomplete', $autocomplete->getInputId());
    }

    public function testValue()
    {
        $form = $this->factory->create('places_autocomplete', 'foo');
        $form->createView();

        $autocomplete = $form->getConfig()->getAttribute('autocomplete');

        $this->assertSame('foo', $autocomplete->getValue());
    }

    public function testView()
    {
        $this->placesAutocompleteHelperMock
            ->expects($this->once())
            ->method('renderHtmlContainer')
            ->will($this->returnValue('html'));

        $this->placesAutocompleteHelperMock
            ->expects($this->once())
            ->method('renderJavascripts')
            ->will($this->returnValue('javascripts'));

        $form = $this->factory->create('places_autocomplete');
        $view = $form->createView();

        $this->assertSame('html', $view->vars['html']);
        $this->assertSame('javascripts', $view->vars['javascripts']);
    }
}
