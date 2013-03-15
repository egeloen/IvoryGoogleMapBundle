<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder;

/**
 * Geocoder request builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder */
    protected $geocoderRequestBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequestBuilder = new GeocoderRequestBuilder(
            'Ivory\GoogleMap\Services\Geocoding\GeocoderRequest'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderRequestBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame(
            'Ivory\GoogleMap\Services\Geocoding\GeocoderRequest',
            $this->geocoderRequestBuilder->getClass()
        );

        $this->assertNull($this->geocoderRequestBuilder->getAddress());
        $this->assertEmpty($this->geocoderRequestBuilder->getCoordinate());
        $this->assertEmpty($this->geocoderRequestBuilder->getBound());
        $this->assertNull($this->geocoderRequestBuilder->getRegion());
        $this->assertNull($this->geocoderRequestBuilder->getLanguage());
        $this->assertNull($this->geocoderRequestBuilder->getSensor());
    }

    public function testSingleBuildWithoutValues()
    {
        $geocoderRequest = $this->geocoderRequestBuilder->build();

        $this->assertNull($geocoderRequest->getAddress());
        $this->assertEmpty($geocoderRequest->getCoordinate());
        $this->assertEmpty($geocoderRequest->getBound());
        $this->assertNull($geocoderRequest->getRegion());
        $this->assertNull($geocoderRequest->getLanguage());
        $this->assertFalse($geocoderRequest->hasSensor());
    }

    public function testSingleBuildWithValues()
    {
        $this->geocoderRequestBuilder
            ->setAddress('foo')
            ->setCoordinate(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $this->assertSame('foo', $this->geocoderRequestBuilder->getAddress());
        $this->assertSame(array(1, 2, false), $this->geocoderRequestBuilder->getCoordinate());
        $this->assertSame(array(1, 2, true, 3, 4, false), $this->geocoderRequestBuilder->getBound());
        $this->assertSame('en', $this->geocoderRequestBuilder->getRegion());
        $this->assertTrue($this->geocoderRequestBuilder->getSensor());

        $geocoderRequest = $this->geocoderRequestBuilder->build();

        $this->assertSame('foo', $geocoderRequest->getAddress());

        $this->assertSame(1, $geocoderRequest->getCoordinate()->getLatitude());
        $this->assertSame(2, $geocoderRequest->getCoordinate()->getLongitude());
        $this->assertFalse($geocoderRequest->getCoordinate()->isNoWrap());

        $this->assertSame(1, $geocoderRequest->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $geocoderRequest->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($geocoderRequest->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $geocoderRequest->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $geocoderRequest->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($geocoderRequest->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame('fr', $geocoderRequest->getLanguage());
        $this->assertSame('en', $geocoderRequest->getRegion());
        $this->assertTrue($geocoderRequest->hasSensor());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->geocoderRequestBuilder
            ->setAddress('foo')
            ->setCoordinate(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $geocoderRequest1 = $this->geocoderRequestBuilder->build();
        $geocoderRequest2 = $this->geocoderRequestBuilder->build();

        $this->assertNotSame($geocoderRequest1, $geocoderRequest2);

        $this->assertSame('foo', $geocoderRequest1->getAddress());

        $this->assertSame(1, $geocoderRequest1->getCoordinate()->getLatitude());
        $this->assertSame(2, $geocoderRequest1->getCoordinate()->getLongitude());
        $this->assertFalse($geocoderRequest1->getCoordinate()->isNoWrap());

        $this->assertSame(1, $geocoderRequest1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $geocoderRequest1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($geocoderRequest1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $geocoderRequest1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $geocoderRequest1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($geocoderRequest1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame('fr', $geocoderRequest1->getLanguage());
        $this->assertSame('en', $geocoderRequest1->getRegion());
        $this->assertTrue($geocoderRequest1->hasSensor());

        $this->assertSame('foo', $geocoderRequest2->getAddress());

        $this->assertSame(1, $geocoderRequest2->getCoordinate()->getLatitude());
        $this->assertSame(2, $geocoderRequest2->getCoordinate()->getLongitude());
        $this->assertFalse($geocoderRequest2->getCoordinate()->isNoWrap());

        $this->assertSame(1, $geocoderRequest2->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $geocoderRequest2->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($geocoderRequest2->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $geocoderRequest2->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $geocoderRequest2->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($geocoderRequest2->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame('fr', $geocoderRequest2->getLanguage());
        $this->assertSame('en', $geocoderRequest2->getRegion());
        $this->assertTrue($geocoderRequest2->hasSensor());
    }

    public function testMultipleBuildWithReset()
    {
        $this->geocoderRequestBuilder
            ->setAddress('foo')
            ->setCoordinate(1, 2, false)
            ->setBound(1, 2, 3, 4, true, false)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $geocoderRequest1 = $this->geocoderRequestBuilder->build();
        $this->geocoderRequestBuilder->reset();
        $geocoderRequest2 = $this->geocoderRequestBuilder->build();

        $this->assertNotSame($geocoderRequest1, $geocoderRequest2);

        $this->assertSame('foo', $geocoderRequest1->getAddress());

        $this->assertSame(1, $geocoderRequest1->getCoordinate()->getLatitude());
        $this->assertSame(2, $geocoderRequest1->getCoordinate()->getLongitude());
        $this->assertFalse($geocoderRequest1->getCoordinate()->isNoWrap());

        $this->assertSame(1, $geocoderRequest1->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $geocoderRequest1->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($geocoderRequest1->getBound()->getSouthWest()->isNoWrap());

        $this->assertSame(3, $geocoderRequest1->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(4, $geocoderRequest1->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($geocoderRequest1->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame('fr', $geocoderRequest1->getLanguage());
        $this->assertSame('en', $geocoderRequest1->getRegion());
        $this->assertTrue($geocoderRequest1->hasSensor());

        $this->assertNull($geocoderRequest2->getAddress());
        $this->assertEmpty($geocoderRequest2->getCoordinate());
        $this->assertEmpty($geocoderRequest2->getBound());
        $this->assertNull($geocoderRequest2->getRegion());
        $this->assertNull($geocoderRequest2->getLanguage());
        $this->assertFalse($geocoderRequest2->hasSensor());
    }
}
