<?php

namespace Ivory\GoogleMapBundle\Model\Layers;

use Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Heatmap layer which describes a google map heatmap layer.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class HeatmapLayer extends AbstractOptionsAsset
{
    protected $locations = array();

    public function __construct()
    {
        $this->setPrefixJavascriptVariable('heatmap_layer_');
    }

    public function addLocation($latitude, $longitude)
    {
        $this->locations[] = new Coordinate($latitude, $longitude);
    }

    public function getLocations()
    {
        return $this->locations;
    }
}
