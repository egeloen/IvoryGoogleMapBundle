<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlStyleHelper;

use Ivory\GoogleMapBundle\Model\Controls\ScaleControl;

/**
 * Scale control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ScaleControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;
    
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControleStyleHelper
     */
    protected $scaleControlStyleHelper;

    /**
     * Construct a scale control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControleStyleHelper $ scaleControlStyleHelper
     */
    public function __construct(ControlPositionHelper $controlPositionHelper, ScaleControlStyleHelper $scaleControlStyleHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
        $this->scaleControlStyleHelper = $scaleControlStyleHelper;
    }

    /**
     * Renders the scale control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\ScaleControl $scaleControl
     * @return string HTML output
     */
    public function render(ScaleControl $scaleControl)
    {
        return sprintf('{"position":%s,"style":%s}',
            $this->controlPositionHelper->render($scaleControl->getControlPosition()),
            $this->scaleControlStyleHelper->render($scaleControl->getScaleControlStyle())
        );
    }
}
