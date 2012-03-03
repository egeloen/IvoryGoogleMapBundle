<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Services\Directions;

use Ivory\GoogleMapBundle\Tests\Model\Services\AbstractServiceTest;
use Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsService;

/**
 * DirectionsService test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsServiceTest extends AbstractServiceTest
{
    /**
     * @override
     */
    public function setUp()
    {
        self::$service = new DirectionsService();
    }

    /**
     * Checks the directions service default values
     */
    public function testDefaultValues()
    {
        parent::testDefaultValues();

        $this->assertEquals(self::$service->getUrl(), 'http://maps.googleapis.com/maps/api/directions');
    }

    /**
     * Checks the route method
     *
     * @todo Finish implementation
     */
    public function testRoute()
    {

    }
}
