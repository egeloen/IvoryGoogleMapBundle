<?php

namespace Ivory\GoogleMapBundle\Tests\Entity;

use Ivory\GoogleMapBundle\Entity\OverviewMapControl;

/**
 * Overview map control entity test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlTest extends \PHPUnit_Framework_TestCase
{    
    /**
     * Checks the overview map control constuctor
     */
    public function testConstructor()
    {
        $overviewMapControlEntityTest = new OverviewMapControl();
        $this->assertInstanceOf('Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl', $overviewMapControlEntityTest);
    }
}
