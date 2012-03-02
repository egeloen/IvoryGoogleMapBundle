<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\ZoomControl;

/**
 * Zoom control helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ZoomControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlStyleHelper
     */
    protected $zoomControlStyleHelper;

    /**
     * Create a zoom control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlStyleHelper $zoomControlStyleHelper
     */
    public function __construct(ControlPositionHelper $controlPositionHelper, ZoomControlStyleHelper $zoomControlStyleHelper)
    {
        $this->controlPositionHelper = $controlPositionHelper;
        $this->zoomControlStyleHelper = $zoomControlStyleHelper;
    }

    /**
     * Renders javascript zoom control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\ZoomControl $zoomControl Zoom control
     * @return HTML output
     */
    public function render(ZoomControl $zoomControl)
    {
        return sprintf('{"position":%s,"style":%s}',
            $this->controlPositionHelper->render($zoomControl->getControlPosition()),
            $this->zoomControlStyleHelper->render($zoomControl->getZoomControlStyle())
        );
    }
}
