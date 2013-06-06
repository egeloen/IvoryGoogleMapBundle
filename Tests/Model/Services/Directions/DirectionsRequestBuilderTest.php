<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder;

/**
 * Directions request builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder */
    protected $directionsRequestBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsRequestBuilder = new DirectionsRequestBuilder(
            'Ivory\GoogleMap\Services\Directions\DirectionsRequest'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsRequestBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame(
            'Ivory\GoogleMap\Services\Directions\DirectionsRequest',
            $this->directionsRequestBuilder->getClass()
        );

        $this->assertNull($this->directionsRequestBuilder->getAvoidHighways());
        $this->assertNull($this->directionsRequestBuilder->getAvoidTolls());
        $this->assertNull($this->directionsRequestBuilder->getDestination());
        $this->assertNull($this->directionsRequestBuilder->getOptimizeWaypoints());
        $this->assertNull($this->directionsRequestBuilder->getOrigin());
        $this->assertNull($this->directionsRequestBuilder->getProvideRouteAlternatives());
        $this->assertNull($this->directionsRequestBuilder->getRegion());
        $this->assertNull($this->directionsRequestBuilder->getLanguage());
        $this->assertNull($this->directionsRequestBuilder->getTravelMode());
        $this->assertNull($this->directionsRequestBuilder->getUnitSystem());
        $this->assertEmpty($this->directionsRequestBuilder->getWaypoints());
        $this->assertNull($this->directionsRequestBuilder->getSensor());
    }

    public function testSingleBuildWithoutValues()
    {
        $directionsRequest = $this->directionsRequestBuilder->build();

        $this->assertNull($directionsRequest->getAvoidHighways());
        $this->assertNull($directionsRequest->getAvoidTolls());
        $this->assertNull($directionsRequest->getDestination());
        $this->assertNull($directionsRequest->getOptimizeWaypoints());
        $this->assertNull($directionsRequest->getOrigin());
        $this->assertNull($directionsRequest->getProvideRouteAlternatives());
        $this->assertNull($directionsRequest->getRegion());
        $this->assertNull($directionsRequest->getLanguage());
        $this->assertNull($directionsRequest->getTravelMode());
        $this->assertNull($directionsRequest->getUnitSystem());
        $this->assertEmpty($directionsRequest->getWaypoints());
        $this->assertFalse($directionsRequest->hasSensor());
    }

    public function testSingleBuildWithValues()
    {
        $this->directionsRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setDestination('foo')
            ->setOptimizeWaypoints(true)
            ->setOrigin('bar')
            ->setProvideRouteAlternatives(true)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setTravelMode(TravelMode::DRIVING)
            ->setUnitSystem(UnitSystem::IMPERIAL)
            ->setWaypoints(array('baz', 'bat'))
            ->setSensor(true);

        $this->assertTrue($this->directionsRequestBuilder->getAvoidHighways());
        $this->assertTrue($this->directionsRequestBuilder->getAvoidTolls());
        $this->assertSame('foo', $this->directionsRequestBuilder->getDestination());
        $this->assertTrue($this->directionsRequestBuilder->getOptimizeWaypoints());
        $this->assertSame('bar', $this->directionsRequestBuilder->getOrigin());
        $this->assertTrue($this->directionsRequestBuilder->getProvideRouteAlternatives());
        $this->assertSame('en', $this->directionsRequestBuilder->getRegion());
        $this->assertSame('fr', $this->directionsRequestBuilder->getLanguage());
        $this->assertSame(TravelMode::DRIVING, $this->directionsRequestBuilder->getTravelMode());
        $this->assertSame(UnitSystem::IMPERIAL, $this->directionsRequestBuilder->getUnitSystem());
        $this->assertSame(array('baz', 'bat'), $this->directionsRequestBuilder->getWaypoints());
        $this->assertTrue($this->directionsRequestBuilder->getSensor());

        $directionsRequest = $this->directionsRequestBuilder->build();

        $this->assertTrue($directionsRequest->getAvoidHighways());
        $this->assertTrue($directionsRequest->getAvoidTolls());
        $this->assertSame('foo', $directionsRequest->getDestination());
        $this->assertTrue($directionsRequest->getOptimizeWaypoints());
        $this->assertSame('bar', $directionsRequest->getOrigin());
        $this->assertTrue($directionsRequest->getProvideRouteAlternatives());
        $this->assertSame('en', $directionsRequest->getRegion());
        $this->assertSame('fr', $directionsRequest->getLanguage());
        $this->assertSame(TravelMode::DRIVING, $directionsRequest->getTravelMode());
        $this->assertSame(UnitSystem::IMPERIAL, $directionsRequest->getUnitSystem());
        $this->assertTrue($directionsRequest->hasSensor());

        $waypoints = $directionsRequest->getWaypoints();

        $this->assertArrayHasKey(0, $waypoints);
        $this->assertSame('baz', $waypoints[0]->getLocation());

        $this->assertArrayHasKey(1, $waypoints);
        $this->assertSame('bat', $waypoints[1]->getLocation());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->directionsRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setDestination('foo')
            ->setOptimizeWaypoints(true)
            ->setOrigin('bar')
            ->setProvideRouteAlternatives(true)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setTravelMode(TravelMode::DRIVING)
            ->setUnitSystem(UnitSystem::IMPERIAL)
            ->setWaypoints(array('baz', 'bat'))
            ->setSensor(true);

        $directionsRequest1 = $this->directionsRequestBuilder->build();
        $directionsRequest2 = $this->directionsRequestBuilder->build();

        $this->assertNotSame($directionsRequest1, $directionsRequest2);

        $this->assertTrue($directionsRequest1->getAvoidHighways());
        $this->assertTrue($directionsRequest1->getAvoidTolls());
        $this->assertSame('foo', $directionsRequest1->getDestination());
        $this->assertTrue($directionsRequest1->getOptimizeWaypoints());
        $this->assertSame('bar', $directionsRequest1->getOrigin());
        $this->assertTrue($directionsRequest1->getProvideRouteAlternatives());
        $this->assertSame('en', $directionsRequest1->getRegion());
        $this->assertSame('fr', $directionsRequest1->getLanguage());
        $this->assertSame(TravelMode::DRIVING, $directionsRequest1->getTravelMode());
        $this->assertSame(UnitSystem::IMPERIAL, $directionsRequest1->getUnitSystem());
        $this->assertTrue($directionsRequest1->hasSensor());

        $waypoints1 = $directionsRequest1->getWaypoints();

        $this->assertArrayHasKey(0, $waypoints1);
        $this->assertSame('baz', $waypoints1[0]->getLocation());

        $this->assertArrayHasKey(1, $waypoints1);
        $this->assertSame('bat', $waypoints1[1]->getLocation());

        $this->assertTrue($directionsRequest2->getAvoidHighways());
        $this->assertTrue($directionsRequest2->getAvoidTolls());
        $this->assertSame('foo', $directionsRequest2->getDestination());
        $this->assertTrue($directionsRequest2->getOptimizeWaypoints());
        $this->assertSame('bar', $directionsRequest2->getOrigin());
        $this->assertTrue($directionsRequest2->getProvideRouteAlternatives());
        $this->assertSame('en', $directionsRequest2->getRegion());
        $this->assertSame('fr', $directionsRequest2->getLanguage());
        $this->assertSame(TravelMode::DRIVING, $directionsRequest2->getTravelMode());
        $this->assertSame(UnitSystem::IMPERIAL, $directionsRequest2->getUnitSystem());
        $this->assertTrue($directionsRequest2->hasSensor());

        $waypoints2 = $directionsRequest2->getWaypoints();

        $this->assertArrayHasKey(0, $waypoints2);
        $this->assertSame('baz', $waypoints2[0]->getLocation());

        $this->assertArrayHasKey(1, $waypoints2);
        $this->assertSame('bat', $waypoints2[1]->getLocation());
    }

    public function testMultipleBuildWithReset()
    {
        $this->directionsRequestBuilder
            ->setAvoidHighways(true)
            ->setAvoidTolls(true)
            ->setDestination('foo')
            ->setOptimizeWaypoints(true)
            ->setOrigin('bar')
            ->setProvideRouteAlternatives(true)
            ->setRegion('en')
            ->setLanguage('fr')
            ->setTravelMode(TravelMode::DRIVING)
            ->setUnitSystem(UnitSystem::IMPERIAL)
            ->setWaypoints(array('baz', 'bat'))
            ->setSensor(true);

        $directionsRequest1 = $this->directionsRequestBuilder->build();
        $this->directionsRequestBuilder->reset();
        $directionsRequest2 = $this->directionsRequestBuilder->build();

        $this->assertNotSame($directionsRequest1, $directionsRequest2);

        $this->assertTrue($directionsRequest1->getAvoidHighways());
        $this->assertTrue($directionsRequest1->getAvoidTolls());
        $this->assertSame('foo', $directionsRequest1->getDestination());
        $this->assertTrue($directionsRequest1->getOptimizeWaypoints());
        $this->assertSame('bar', $directionsRequest1->getOrigin());
        $this->assertTrue($directionsRequest1->getProvideRouteAlternatives());
        $this->assertSame('en', $directionsRequest1->getRegion());
        $this->assertSame('fr', $directionsRequest1->getLanguage());
        $this->assertSame(TravelMode::DRIVING, $directionsRequest1->getTravelMode());
        $this->assertSame(UnitSystem::IMPERIAL, $directionsRequest1->getUnitSystem());
        $this->assertTrue($directionsRequest1->hasSensor());

        $waypoints1 = $directionsRequest1->getWaypoints();

        $this->assertArrayHasKey(0, $waypoints1);
        $this->assertSame('baz', $waypoints1[0]->getLocation());

        $this->assertArrayHasKey(1, $waypoints1);
        $this->assertSame('bat', $waypoints1[1]->getLocation());

        $this->assertNull($directionsRequest2->getAvoidHighways());
        $this->assertNull($directionsRequest2->getAvoidTolls());
        $this->assertNull($directionsRequest2->getDestination());
        $this->assertNull($directionsRequest2->getOptimizeWaypoints());
        $this->assertNull($directionsRequest2->getOrigin());
        $this->assertNull($directionsRequest2->getProvideRouteAlternatives());
        $this->assertNull($directionsRequest2->getRegion());
        $this->assertNull($directionsRequest2->getLanguage());
        $this->assertNull($directionsRequest2->getTravelMode());
        $this->assertNull($directionsRequest2->getUnitSystem());
        $this->assertEmpty($directionsRequest2->getWaypoints());
        $this->assertFalse($directionsRequest2->hasSensor());
    }
}
