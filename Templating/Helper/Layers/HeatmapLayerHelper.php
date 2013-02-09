<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Layers;

use Ivory\GoogleMapBundle\Model\Layers\HeatmapLayer;
use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper;
use Zend\Json\Expr;
use Zend\Json\Json;

/**
 * Heatmap layer helper.
 *
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class HeatmapLayerHelper
{
    public function render(HeatmapLayer $heatmapLayer, Map $map)
    {
        $coordinateHelper = new CoordinateHelper();

        $heatmapLayerOptions = $heatmapLayer->getOptions();

        $heatmapLayerOptions['data'] = array();
        foreach ($heatmapLayer->getLocations() as $location) {
            $heatmapLayerOptions['data'][] = new Expr($coordinateHelper->render($location));
        }

        $heatmapLayerOptions['map'] = new Expr($map->getJavascriptVariable());

        return sprintf('var %s = new google.maps.visualization.HeatmapLayer(%s);'.PHP_EOL,
            $heatmapLayer->getJavascriptVariable(),
            Json::encode($heatmapLayerOptions, false, array('enableJsonExprFinder' => true))
        );
    }
}
