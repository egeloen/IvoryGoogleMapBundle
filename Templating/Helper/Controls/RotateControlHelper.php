<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\RotateControl;

/**
 * Rotate control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;
    
    /**
     * Creates a rotate control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper 
     */
    public function __construct(ControlPositionHelper $controlPositionHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
    }
    
    /**
     * Renders the rotate control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\RotateControl $rotateControl
     * @return string HTML output
     */
    public function render(RotateControl $rotateControl)
    {
        return sprintf('{"position":%s}',
            $this->controlPositionHelper->render($rotateControl->getControlPosition())
        );
    }
}
