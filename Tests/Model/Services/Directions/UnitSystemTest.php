<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\Directions\UnitSystem;

/**
 * UnitSystem test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class UnitSystemTest 
{
    /**
     * Checks the disable constructor
     */
    public function testConstruct()
    {
        try
        {
            $unitSystemTest = new UnitSystem();
            $this->fail('The class "Ivory\GoogleMapBundle\Model\Services\Directions\UnitSystem" can not be instanciated.');
        }
        catch(\Exception $e){}
    }
    
    /**
     * Checks the unit systems getter
     */
    public function testUnitSystems()
    {
        $this->assertEquals(UnitSystem::getUnitSystems(), array(
            UnitSystem::IMPERIAL,
            UnitSystem::METRIC
        ));
    }
}
