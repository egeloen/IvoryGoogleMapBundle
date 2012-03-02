<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Controls;

use Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlStyleHelper;

use Ivory\GoogleMapBundle\Model\Controls\MapTypeControl;

/**
 * Map type control helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper
     */
    protected $mapTypeIdHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper
     */
    protected $controlPositionHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControleStyleHelper
     */
    protected $mapTypeControlStyleHelper;

    /**
     * Construct a map type control helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper $mapTypeIdHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ControlPositionHelper $controlPositionHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControleStyleHelper
     */
    public function __construct(MapTypeIdHelper $mapTypeIdHelper, ControlPositionHelper $controlPositionHelper, MapTypeControlStyleHelper $mapTypeControlStyleHelper)
    {
        $this->mapTypeIdHelper = $mapTypeIdHelper;
        $this->controlPositionHelper = $controlPositionHelper;
        $this->mapTypeControlStyleHelper = $mapTypeControlStyleHelper;
    }

    /**
     * Renders the map type control
     *
     * @param Ivory\GoogleMapBundle\Model\Controls\MapTypeControl $mapTypeControl
     * @return string HTML output
     */
    public function render(MapTypeControl $mapTypeControl)
    {
        $mapTypeIds = array();

        foreach($mapTypeControl->getMapTypeIds() as $mapTypeId)
            $mapTypeIds[] = $this->mapTypeIdHelper->render($mapTypeId);

        return sprintf('{"mapTypeIds":[%s],"position":%s,"style":%s}',
            implode(', ', $mapTypeIds),
            $this->controlPositionHelper->render($mapTypeControl->getControlPosition()),
            $this->mapTypeControlStyleHelper->render($mapTypeControl->getMapTypeControlStyle())
        );
    }
}
