<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\StreetViewControl;

/**
 * Street view control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;
    
    /**
     * Creates a street view control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper 
     */
    public function __construct(ControlPositionHelper $controlPositionHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
    }
    
    /**
     * Renders the street view control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\StreetViewControl $streetViewControl
     * @return string HTML output
     */
    public function render(StreetViewControl $streetViewControl)
    {
        return sprintf('{"position":%s}',
            $this->controlPositionHelper->render($streetViewControl->getControlPosition())
        );
    }
}
