<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\TravelMode;

/**
 * TravelMode test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TravelModeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $travelModeTest = new TravelMode();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Directions\TravelMode" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the travel modes getter
     */
    public function testTravelModes()
    {
        $this->assertEquals(TravelMode::getTravelModes(), array(
            TravelMode::BICYCLING,
            TravelMode::DRIVING,
            TravelMode::WALKING
        ));
    }
}
