<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Templating;

use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper as BasePlaceAutocompleteHelper;
use Ivory\GoogleMap\Place\Autocomplete;
use Ivory\GoogleMapBundle\Templating\PlaceAutocompleteHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteHelperTest extends TestCase
{
    /**
     * @var PlaceAutocompleteHelper
     */
    private $placeAutocompleteHelper;

    /**
     * @var BasePlaceAutocompleteHelper|\PHPUnit_Framework_MockObject_MockObject
     */
    private $innerPlaceAutocompleteHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->innerPlaceAutocompleteHelper = $this->createPlaceAutocompleteHelperMock();
        $this->placeAutocompleteHelper = new PlaceAutocompleteHelper($this->innerPlaceAutocompleteHelper);
    }

    public function testRender()
    {
        $this->innerPlaceAutocompleteHelper
            ->expects($this->once())
            ->method('render')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->placeAutocompleteHelper->render($autocomplete));
    }

    public function testRenderHtml()
    {
        $this->innerPlaceAutocompleteHelper
            ->expects($this->once())
            ->method('renderHtml')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->placeAutocompleteHelper->renderHtml($autocomplete));
    }

    public function testRenderJavascript()
    {
        $this->innerPlaceAutocompleteHelper
            ->expects($this->once())
            ->method('renderJavascript')
            ->with($this->identicalTo($autocomplete = $this->createAutocompleteMock()))
            ->will($this->returnValue($result = 'result'));

        $this->assertSame($result, $this->placeAutocompleteHelper->renderJavascript($autocomplete));
    }

    public function testName()
    {
        $this->assertSame('ivory_google_place_autocomplete', $this->placeAutocompleteHelper->getName());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|BasePlaceAutocompleteHelper
     */
    private function createPlaceAutocompleteHelperMock()
    {
        return $this->createMock(BasePlaceAutocompleteHelper::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Autocomplete
     */
    private function createAutocompleteMock()
    {
        return $this->createMock(Autocomplete::class);
    }
}
