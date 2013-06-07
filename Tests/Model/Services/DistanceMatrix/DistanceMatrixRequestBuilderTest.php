<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Services\DistanceMatrix;

use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder;

/**
 * Distance matrix request builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder */
    protected $distanceMatrixRequestBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->distanceMatrixRequestBuilder = new DistanceMatrixRequestBuilder(
            'Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->distanceMatrixRequestBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame(
            'Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest',
            $this->distanceMatrixRequestBuilder->getClass()
        );

        $this->assertNull($this->distanceMatrixRequestBuilder->getAvoidHighways());
        $this->assertNull($this->distanceMatrixRequestBuilder->getAvoidTolls());
        $this->assertEmpty($this->distanceMatrixRequestBuilder->getOrigins());
        $this->assertEmpty($this->distanceMatrixRequestBuilder->getDestinations());
        $this->assertNull($this->distanceMatrixRequestBuilder->getTravelMode());
        $this->assertNull($this->distanceMatrixRequestBuilder->getUnitSystem());
        $this->assertNull($this->distanceMatrixRequestBuilder->getRegion());
        $this->assertNull($this->distanceMatrixRequestBuilder->getLanguage());
        $this->assertNull($this->distanceMatrixRequestBuilder->getSensor());
    }

    public function testSingleBuildWithoutValues()
    {
        $directionsRequest = $this->distanceMatrixRequestBuilder->build();

        $this->assertNull($directionsRequest->getAvoidHighways());
        $this->assertNull($directionsRequest->getAvoidTolls());
        $this->assertEmpty($directionsRequest->getOrigins());
        $this->assertEmpty($directionsRequest->getDestinations());
        $this->assertNull($directionsRequest->getTravelMode());
        $this->assertNull($directionsRequest->getUnitSystem());
        $this->assertNull($directionsRequest->getRegion());
        $this->assertNull($directionsRequest->getLanguage());
        $this->assertFalse($directionsRequest->hasSensor());
    }

    public function testSingleBuildWithValues()
    {
        $this->distanceMatrixRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setOrigins(array('bar'))
            ->setDestinations(array('foo'))
            ->setTravelMode(TravelMode::BICYCLING)
            ->setUnitSystem(UnitSystem::METRIC)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $this->assertTrue($this->distanceMatrixRequestBuilder->getAvoidHighways());
        $this->assertTrue($this->distanceMatrixRequestBuilder->getAvoidTolls());
        $this->assertSame(array('bar'), $this->distanceMatrixRequestBuilder->getOrigins());
        $this->assertSame(array('foo'), $this->distanceMatrixRequestBuilder->getDestinations());
        $this->assertSame(TravelMode::BICYCLING, $this->distanceMatrixRequestBuilder->getTravelMode());
        $this->assertSame(UnitSystem::METRIC, $this->distanceMatrixRequestBuilder->getUnitSystem());
        $this->assertSame('en', $this->distanceMatrixRequestBuilder->getRegion());
        $this->assertSame('fr', $this->distanceMatrixRequestBuilder->getLanguage());
        $this->assertTrue($this->distanceMatrixRequestBuilder->getSensor());

        $directionsRequest = $this->distanceMatrixRequestBuilder->build();

        $this->assertTrue($directionsRequest->getAvoidHighways());
        $this->assertTrue($directionsRequest->getAvoidTolls());
        $this->assertSame(array('bar'), $directionsRequest->getOrigins());
        $this->assertSame(array('foo'), $directionsRequest->getDestinations());
        $this->assertSame(TravelMode::BICYCLING, $directionsRequest->getTravelMode());
        $this->assertSame(UnitSystem::METRIC, $directionsRequest->getUnitSystem());
        $this->assertSame('en', $directionsRequest->getRegion());
        $this->assertSame('fr', $directionsRequest->getLanguage());
        $this->assertTrue($directionsRequest->hasSensor());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->distanceMatrixRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setOrigins(array('bar'))
            ->setDestinations(array('foo'))
            ->setTravelMode(TravelMode::BICYCLING)
            ->setUnitSystem(UnitSystem::METRIC)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $directionsRequest1 = $this->distanceMatrixRequestBuilder->build();
        $directionsRequest2 = $this->distanceMatrixRequestBuilder->build();

        $this->assertNotSame($directionsRequest1, $directionsRequest2);

        $this->assertTrue($directionsRequest1->getAvoidHighways());
        $this->assertTrue($directionsRequest1->getAvoidTolls());
        $this->assertSame(array('bar'), $directionsRequest1->getOrigins());
        $this->assertSame(array('foo'), $directionsRequest1->getDestinations());
        $this->assertSame(TravelMode::BICYCLING, $directionsRequest1->getTravelMode());
        $this->assertSame(UnitSystem::METRIC, $directionsRequest1->getUnitSystem());
        $this->assertSame('en', $directionsRequest1->getRegion());
        $this->assertSame('fr', $directionsRequest1->getLanguage());
        $this->assertTrue($directionsRequest1->hasSensor());

        $this->assertTrue($directionsRequest2->getAvoidHighways());
        $this->assertTrue($directionsRequest2->getAvoidTolls());
        $this->assertSame(array('bar'), $directionsRequest2->getOrigins());
        $this->assertSame(array('foo'), $directionsRequest2->getDestinations());
        $this->assertSame(TravelMode::BICYCLING, $directionsRequest2->getTravelMode());
        $this->assertSame(UnitSystem::METRIC, $directionsRequest2->getUnitSystem());
        $this->assertSame('en', $directionsRequest2->getRegion());
        $this->assertSame('fr', $directionsRequest2->getLanguage());
        $this->assertTrue($directionsRequest2->hasSensor());
    }

    public function testMultipleBuildWithReset()
    {
        $this->distanceMatrixRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setOrigins(array('bar'))
            ->setDestinations(array('foo'))
            ->setTravelMode(TravelMode::BICYCLING)
            ->setUnitSystem(UnitSystem::METRIC)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setSensor(true);

        $directionsRequest1 = $this->distanceMatrixRequestBuilder->build();
        $this->distanceMatrixRequestBuilder->reset();
        $directionsRequest2 = $this->distanceMatrixRequestBuilder->build();

        $this->assertNotSame($directionsRequest1, $directionsRequest2);

        $this->assertTrue($directionsRequest1->getAvoidHighways());
        $this->assertTrue($directionsRequest1->getAvoidTolls());
        $this->assertSame(array('bar'), $directionsRequest1->getOrigins());
        $this->assertSame(array('foo'), $directionsRequest1->getDestinations());
        $this->assertSame(TravelMode::BICYCLING, $directionsRequest1->getTravelMode());
        $this->assertSame(UnitSystem::METRIC, $directionsRequest1->getUnitSystem());
        $this->assertSame('en', $directionsRequest1->getRegion());
        $this->assertSame('fr', $directionsRequest1->getLanguage());
        $this->assertTrue($directionsRequest1->hasSensor());

        $this->assertNull($directionsRequest2->getAvoidHighways());
        $this->assertNull($directionsRequest2->getAvoidTolls());
        $this->assertEmpty($directionsRequest2->getOrigins());
        $this->assertEmpty($directionsRequest2->getDestinations());
        $this->assertNull($directionsRequest2->getTravelMode());
        $this->assertNull($directionsRequest2->getUnitSystem());
        $this->assertNull($directionsRequest2->getRegion());
        $this->assertNull($directionsRequest2->getLanguage());
        $this->assertFalse($directionsRequest2->hasSensor());
    }
}
