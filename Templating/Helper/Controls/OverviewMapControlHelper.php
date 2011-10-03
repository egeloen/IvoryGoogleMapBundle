<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl;

/**
 * Overview map control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlHelper
{
    /**
     * Renders the overview map control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl $overviewMapControl
     * @return string HTML output
     */
    public function render(OverviewMapControl $overviewMapControl)
    {
        return sprintf('{"opened":%s}',
            json_encode($overviewMapControl->isOpened())
        );
    }
}
