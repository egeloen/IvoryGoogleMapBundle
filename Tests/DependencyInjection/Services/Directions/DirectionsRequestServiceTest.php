<?php

namespace Ivory\GoogleMapBundle\Tests\DependencyInjection\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Emulation\WebTestCase;

/**
 * Directions request service test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequestServiceTest extends WebTestCase
{
    /**
     * Checks the Directions request service without configuration
     */
    public function testDirectionsRequestServiceWithoutConfiguration()
    {
        $request = self::createContainer()->get('ivory_google_map.directions_request');

        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest', $request);
        $this->assertFalse($request->hasAvoidHighWays());
        $this->assertFalse($request->hasAvoidTolls());
        $this->assertFalse($request->hasDestination());
        $this->assertFalse($request->hasOptimizeWaypoints());
        $this->assertFalse($request->hasOrigin());
        $this->assertFalse($request->hasProvideRouteAlternatives());
        $this->assertFalse($request->hasRegion());
        $this->assertFalse($request->hasTravelMode());
        $this->assertFalse($request->hasUnitSystem());
        $this->assertFalse($request->hasWaypoints());
        $this->assertFalse($request->hasSensor());
    }

    /**
     * Checks the Directions request service with configuration
     */
    public function testDirectionsRequestServiceWithConfiguration()
    {
        $request = self::createContainer(array('environment' => 'test'))->get('ivory_google_map.directions_request');

        $this->assertTrue($request->hasAvoidHighways());
        $this->assertTrue($request->getAvoidHighways());

        $this->assertTrue($request->hasAvoidTolls());
        $this->assertTrue($request->getAvoidTolls());

        $this->assertTrue($request->hasOptimizeWaypoints());
        $this->assertTrue($request->getOptimizeWaypoints());

        $this->assertTrue($request->hasProvideRouteAlternatives());
        $this->assertTrue($request->getProvideRouteAlternatives());

        $this->assertTrue($request->hasRegion());
        $this->assertEquals($request->getRegion(), 'es');

        $this->assertTrue($request->hasTravelMode());
        $this->assertEquals($request->getTravelMode(), 'WALKING');

        $this->assertTrue($request->hasUnitSystem());
        $this->assertEquals($request->getUnitSystem(), 'IMPERIAL');

        $this->assertTrue($request->hasSensor());
    }
}
