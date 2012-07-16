<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\Base;
use Ivory\GoogleMapBundle\Templating\Helper\Controls;
use Ivory\GoogleMapBundle\Templating\Helper\Layers;
use Ivory\GoogleMapBundle\Templating\Helper\Overlays;
use Ivory\GoogleMapBundle\Templating\Helper\Events;

use Ivory\GoogleMapBundle\Model\Map;
use Ivory\GoogleMapBundle\Model\Events\Event;

/**
 * Map helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper extends Helper
{
    /**
     * @var boolean TRUE if the google map api has already been loaded else FALSE.
     */
    static protected $apiIsLoaded = false;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper
     */
    protected $mapTypeIdHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlHelper
     */
    protected $mapTypeControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\OverviewMapControlHelper
     */
    protected $overviewMapControl;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\PanControlHelper
     */
    protected $panControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\RotateControlHelper
     */
    protected $rotateControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlHelper
     */
    protected $scaleControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\StreetViewControlHelper
     */
    protected $streetViewControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlHelper
     */
    protected $zoomControlHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerHelper
     */
    protected $markerHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper
     */
    protected $boundHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper
     */
    protected $infoWindowHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper
     */
    protected $polylineHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\EncodedPolylineHelper
     */
    protected $encodedPolylineHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolygonHelper
     */
    protected $polygonHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\RectangleHelper
     */
    protected $rectangleHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper
     */
    protected $circleHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper
     */
    protected $groundOverlayHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Layers\KMLLayer
     */
    protected $kmlLayerHelper;

    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Events\EventManagerHelper
     */
    protected $eventManagerHelper;

    /**
     * Constructs a map helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\MapTypeIdHelper $mapTypeIdHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\MapTypeControlHelper $mapTypeControlHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\OverviewMapControlHelper $overviewMapControl
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\PanControlHelper $panControlHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\RotateControlHelper $rotateControlHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ScaleControlHelper $scaleControlhelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\StreetViewControlHelper $streetViewControlHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Controls\ZoomControlHelper $zoomControlHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerHelper $markerHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper $boundHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper $infoWindowHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper $polylineHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\EncodedPolylineHelper $encodedPolylineHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper $circleHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper $groundOverlayHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Layers\KMLLayer $kmlLayerHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Events\EventManagerHelper $eventHelper
     */
    public function __construct(
        Base\CoordinateHelper $coordinateHelper,
        MapTypeIdHelper $mapTypeIdHelper,
        Controls\MapTypeControlHelper $mapTypeControlHelper,
        Controls\OverviewMapControlHelper $overviewMapControlHelper,
        Controls\PanControlHelper $panControlHelper,
        Controls\RotateControlHelper $rotateControlHelper,
        Controls\ScaleControlHelper $scaleControlHelper,
        Controls\StreetViewControlHelper $streetViewControlHelper,
        Controls\ZoomControlHelper $zoomControlHelper,
        Overlays\MarkerHelper $markerHelper,
        Base\BoundHelper $boundHelper,
        Overlays\InfoWindowHelper $infoWindowHelper,
        Overlays\PolylineHelper $polylineHelper,
        Overlays\EncodedPolylineHelper $encodedPolylineHelper,
        Overlays\PolygonHelper $polygonHelper,
        Overlays\RectangleHelper $rectangleHelper,
        Overlays\CircleHelper $circleHelper,
        Overlays\GroundOverlayHelper $groundOverlayHelper,
        Layers\KMLLayerHelper $kmlLayerHelper,
        Events\EventManagerHelper $eventManagerHelper
    ) {
        $this->coordinateHelper = $coordinateHelper;
        $this->mapTypeIdHelper = $mapTypeIdHelper;
        $this->mapTypeControlHelper = $mapTypeControlHelper;
        $this->overviewMapControlHelper = $overviewMapControlHelper;
        $this->panControlHelper = $panControlHelper;
        $this->rotateControlHelper = $rotateControlHelper;
        $this->scaleControlHelper = $scaleControlHelper;
        $this->streetViewControlHelper = $streetViewControlHelper;
        $this->zoomControlHelper = $zoomControlHelper;
        $this->markerHelper = $markerHelper;
        $this->boundHelper = $boundHelper;
        $this->infoWindowHelper = $infoWindowHelper;
        $this->polylineHelper = $polylineHelper;
        $this->encodedPolylineHelper = $encodedPolylineHelper;
        $this->polygonHelper = $polygonHelper;
        $this->rectangleHelper = $rectangleHelper;
        $this->circleHelper = $circleHelper;
        $this->groundOverlayHelper = $groundOverlayHelper;
        $this->kmlLayerHelper = $kmlLayerHelper;
        $this->eventManagerHelper = $eventManagerHelper;
    }

    /**
     * Renders the map container
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderContainer(Map $map)
    {
        return sprintf('<div id="%s" style="width:%s;height:%s;"></div>'.PHP_EOL,
            $map->getHtmlContainerId(),
            $map->getStylesheetOption('width'),
            $map->getStylesheetOption('height')
        );
    }

    /**
     * Renders the map stylesheets
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderStylesheets(Map $map)
    {
        $html = array();

        $html[] = '<style type="text/css">'.PHP_EOL;
        $html[] = '#'.$map->getHtmlContainerId().'{'.PHP_EOL;

        foreach($map->getStylesheetOptions() as $option => $value)
            $html[] = $option.':'.$value.';'.PHP_EOL;

        $html[] = '}'.PHP_EOL;
        $html[] = '</style>'.PHP_EOL;

        return implode('', $html);
    }

    /**
     * Renders the map javascripts
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderJavascripts(Map $map)
    {
        $html = array();

        if (!self::$apiIsLoaded)
            $html[] = $this->renderGoogleMapAPI($map);

        $html[] = '<script type="text/javascript">'.PHP_EOL;

        if($map->isAsync())
            $html[] = 'function load_ivory_google_map() {'.PHP_EOL;

        $html[] = $this->renderMap($map);
        $html[] = $this->renderMarkers($map);
        $html[] = $this->renderInfoWindows($map);
        $html[] = $this->renderPolylines($map);
        $html[] = $this->renderEncodedPolylines($map);
        $html[] = $this->renderPolygons($map);
        $html[] = $this->renderRectangles($map);
        $html[] = $this->renderCircles($map);
        $html[] = $this->renderGroundOverlays($map);

        if($map->isAutoZoom())
            $html[] = $this->renderBound($map);
        else
            $html[] = $this->renderCenter($map);

        $html[] = $this->renderKMLLayers($map);

        $html[] = $this->renderGlobalVariables($map);
        $html[] = $this->renderEvents($map);

        if($map->isAsync()) {
            $html[] = '}'.PHP_EOL;
        }

        $html[] = '</script>'.PHP_EOL;

        return implode('', $html);
    }

    /**
     * Renders the google map API.
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string The google map API
     */
    protected function renderGoogleMapAPI(Map $map)
    {
        self::$apiIsLoaded = true;

        $url = '//maps.google.com/maps/api/js?';

        $encodedPolylines = $map->getEncodedPolylines();
        if (!empty($encodedPolylines))
            $url .= 'libraries=geometry&';

        if ($map->isAsync())
            $url .= 'callback=load_ivory_google_map&';

        $url .= sprintf('language=%s&sensor=false',
            $map->getLanguage()
        );

        return sprintf('<script type="text/javascript" src="%s"></script>'.PHP_EOL,
            $url
        );
    }

    /**
     * Renders the global map variables
     *
     * @return string HTML output
     */
    public function renderGlobalVariables(Map $map)
    {
        $html = array();

        $closableInfoWindows = array();
        foreach($map->getInfoWindows() as $infoWindow)
        {
            if($infoWindow->isAutoClose())
                $closableInfoWindows[] = $infoWindow->getJavascriptVariable();
        }

        foreach($map->getMarkers() as $marker)
        {
            if($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoClose())
                $closableInfoWindows[] = $marker->getInfoWindow()->getJavascriptVariable();
        }

        $html[] = sprintf('var closable_info_windows = Array(%s);'.PHP_EOL, implode(', ', $closableInfoWindows));

        return implode('', $html);
    }

    /**
     * Renders the map javascript variable
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderMap(Map $map)
    {
        $html = array();

        $mapControlJSONOptions = $this->renderMapControls($map);

        $mapOptions = $map->getMapOptions();

        $mapJSONOptions = '{"mapTypeId":'.$this->mapTypeIdHelper->render($mapOptions['mapTypeId']);
        unset($mapOptions['mapTypeId']);

        if(!empty($mapControlJSONOptions))
            $mapJSONOptions .= ','.$mapControlJSONOptions;

        if($map->isAutoZoom() && isset($mapOptions['zoom']))
            unset($mapOptions['zoom']);

        if(!empty($mapOptions))
            $mapJSONOptions .= ','.substr(json_encode($mapOptions), 1);
        else
            $mapJSONOptions .= '}';

        $html[] = sprintf('var %s = new google.maps.Map(document.getElementById("%s"), %s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getHtmlContainerId(),
            $mapJSONOptions
        );

        return implode('', $html);
    }

    /**
     * Renders the map controls
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string Map controls
     */
    protected function renderMapControls(Map &$map)
    {
        $mapControls = array();
        $controlNames = array('MapTypeControl', 'OverviewMapControl', 'PanControl', 'RotateControl', 'ScaleControl', 'StreetViewControl', 'ZoomControl');

        foreach($controlNames as $controlName)
        {
            $controlHelper = lcfirst($controlName).'Helper';

            $mapControlJSONOption = $this->renderMapControl($map, $controlName, $this->$controlHelper);
            if(!empty($mapControlJSONOption))
                $mapControls[] = $mapControlJSONOption;
        }

        return implode(',', $mapControls);
    }

    /**
     * Renders the map control
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @param string $controlName
     * @param mixed $controlHelper
     * @return string Map control
     */
    protected function renderMapControl(Map &$map, $controlName, $controlHelper)
    {
        $mapControl = array();
        $lcFirstControlName = lcfirst($controlName);

        if($map->hasMapOption($lcFirstControlName))
        {
            if($map->getMapOption($lcFirstControlName))
            {
                $mapControl[] = sprintf('"%s":true', $lcFirstControlName);

                $hasControlMethod = 'has'.$controlName;
                if($map->$hasControlMethod())
                {
                    $getControlMethod = 'get'.$controlName;

                    $mapControl[] = sprintf('"%sOptions":%s',
                        $lcFirstControlName,
                        $controlHelper->render($map->$getControlMethod())
                    );
                }
            }
            else
                $mapControl[] = sprintf('"%s":false', $lcFirstControlName);

            $map->removeMapOption($lcFirstControlName);
        }

        return implode(',', $mapControl);
    }

    /**
     * Renders the map javascript center
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderCenter(Map $map)
    {
        return sprintf('%s.setCenter(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $this->coordinateHelper->render($map->getCenter())
        );
    }

    /**
     * Renders the map javascript bound
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderBound(Map $map)
    {
        $html = array();

        $html[] = $this->boundHelper->render($map->getBound());
        $html[] = sprintf('%s.fitBounds(%s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getBound()->getJavascriptVariable()
        );

        return implode('', $html);
    }

    /**
     * Renders the map javascript markers
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderMarkers(Map $map)
    {
        $html = array();

        foreach($map->getMarkers() as $marker)
        {
            $html[] = $this->markerHelper->render($marker, $map);

            if($marker->hasInfoWindow() && $marker->getInfoWindow()->isAutoOpen())
            {
                $event = new Event();
                $event->setInstance($marker->getJavascriptVariable());
                $event->setEventName($marker->getInfoWindow()->getOpenEvent());
                $event->setHandle(sprintf('function(){for(var info_window in closable_info_windows){closable_info_windows[info_window].close();}%s}',
                    str_replace(PHP_EOL, '', $this->infoWindowHelper->renderOpen($marker->getInfoWindow(), $map, $marker))
                ));

                $map->getEventManager()->addEvent($event);

            }
        }

        return implode('', $html);
    }

    /**
     * Renders the map javascript info window
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderInfoWindows(Map $map)
    {
        $html = array();

        foreach($map->getInfoWindows() as $infoWindow)
        {
            $html[] = $this->infoWindowHelper->render($infoWindow);

            if($infoWindow->isOpen())
                $html[] = $this->infoWindowHelper->renderOpen($infoWindow, $map);
        }

        return implode('', $html);
    }

    /**
     * Renders the map javascript polylines
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderPolylines(Map $map)
    {
        $html = array();

        foreach($map->getPolylines() as $polyline)
            $html[] = $this->polylineHelper->render($polyline, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript encoded polylines
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderEncodedPolylines(Map $map)
    {
        $html = array();

        foreach($map->getEncodedPolylines() as $encodedPolyline)
            $html[] = $this->encodedPolylineHelper->render($encodedPolyline, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript polygons
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderPolygons(Map $map)
    {
        $html = array();

        foreach($map->getPolygons() as $polygon)
            $html[] = $this->polygonHelper->render($polygon, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript rectangles
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderRectangles(Map $map)
    {
        $html = array();

        foreach($map->getRectangles() as $rectangle)
            $html[] = $this->rectangleHelper->render($rectangle, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript circles
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderCircles(Map $map)
    {
        $html = array();

        foreach($map->getCircles() as $circle)
            $html[] = $this->circleHelper->render($circle, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript ground overlays
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderGroundOverlays(Map $map)
    {
        $html = array();

        foreach($map->getGroundOverlays() as $groundOverlay)
            $html[] = $this->groundOverlayHelper->render($groundOverlay, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript KML layers
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderKMLLayers(Map $map)
    {
        $html = array();

        foreach ($map->getKMLLayers() as $kmlLayer)
            $html[] = $this->kmlLayerHelper->render($kmlLayer, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript events
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderEvents(Map $map)
    {
        return $this->eventManagerHelper->render($map->getEventManager());
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
}
