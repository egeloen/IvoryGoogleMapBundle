<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\PanControl;

/**
 * Pan control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;
    
    /**
     * Creates a pan control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper 
     */
    public function __construct(ControlPositionHelper $controlPositionHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
    }
    
    /**
     * Renders the pan control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\PanControl $panControl
     * @return string HTML output
     */
    public function render(PanControl $panControl)
    {
        return sprintf('{"position":%s}',
            $this->controlPositionHelper->render($panControl->getControlPosition())
        );
    }
}
