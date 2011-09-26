<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Templating\Helper\Base;
use Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Model\Map;

/**
 * Map helper allows easy rendering
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper
     */
    protected $coordinateHelper;

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
     * @var Ivory\GoogleMapBundle\Templating\Helper\EventHelper
     */
    protected $eventHelper;
    
    /**
     * Constructs a map helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\CoordinateHelper $coordinateHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerHelper $markerHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Base\BoundHelper $boundHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\InfoWindowHelper $infoWindowHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\PolylineHelper $polylineHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\CircleHelper $circleHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\Overlays\GroundOverlayHelper $groundOverlayHelper
     * @param Ivory\GoogleMapBundle\Templating\Helper\EventHelper $eventHelper
     */
    public function __construct(Base\CoordinateHelper $coordinateHelper, Overlays\MarkerHelper $markerHelper, Base\BoundHelper $boundHelper, Overlays\InfoWindowHelper $infoWindowHelper, Overlays\PolylineHelper $polylineHelper, Overlays\PolygonHelper $polygonHelper, Overlays\RectangleHelper $rectangleHelper, Overlays\CircleHelper $circleHelper, Overlays\GroundOverlayHelper $groundOverlayHelper, EventHelper $eventHelper)
    {
        $this->coordinateHelper = $coordinateHelper;
        $this->markerHelper = $markerHelper;
        $this->boundHelper = $boundHelper;
        $this->infoWindowHelper = $infoWindowHelper;
        $this->polylineHelper = $polylineHelper;
        $this->polygonHelper = $polygonHelper;
        $this->rectangleHelper = $rectangleHelper;
        $this->circleHelper = $circleHelper;
        $this->groundOverlayHelper = $groundOverlayHelper;
        $this->eventHelper = $eventHelper;
    }

    /**
     * Renders the map container
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderContainer(Map $map)
    {
        return sprintf('<div id="%s"></div>', $map->getHtmlContainerId());
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

        $html[] = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>'.PHP_EOL;
        $html[] = '<script type="text/javascript">'.PHP_EOL;
        $html[] = $this->renderMap($map);
        $html[] = $this->renderMarkers($map);
        $html[] = $this->renderInfoWindows($map);
        $html[] = $this->renderPolylines($map);
        $html[] = $this->renderPolygons($map);
        $html[] = $this->renderRectangles($map);
        $html[] = $this->renderCircles($map);
        $html[] = $this->renderGroundOverlays($map);

        if($map->isAutoZoom())
            $html[] = $this->renderBound($map);
        else
            $html[] = $this->renderCenter($map);
        
        $html[] = $this->renderEvents($map);
        $html[] = '</script>';
        
        return implode('', $html);
    }

    /**
     * Renders the map javascript variable
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    protected function renderMap(Map $map)
    {
        $options = $map->getMapOptions();

        if($map->isAutoZoom() && isset($options['zoom']))
            unset($options['zoom']);
        
        return sprintf('var %s = new google.maps.Map(document.getElementById("%s"), %s);'.PHP_EOL,
            $map->getJavascriptVariable(),
            $map->getHtmlContainerId(),
            json_encode($options)
        );
    }

    /**
     * Renders the map javascript center
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    protected function renderCenter(Map $map)
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
    protected function renderBound(Map $map)
    {
        $html = array();
        
        $html[] = $this->boundHelper->render($map->getBound());
        
        if(!$map->getBound()->hasCoordinates() && $map->getBound()->hasExtends())
            $html[] = $this->boundHelper->renderExtends($map->getBound());
        
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
    protected function renderMarkers(Map $map)
    {
        $html = array();

        foreach($map->getMarkers() as $marker)
            $html[] = $this->markerHelper->render($marker, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript info window
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    protected function renderInfoWindows(Map $map)
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
    protected function renderPolylines(Map $map)
    {
        $html = array();

        foreach($map->getPolylines() as $polyline)
            $html[] = $this->polylineHelper->render($polyline, $map);

        return implode('', $html);
    }

    /**
     * Renders the map javascript polygons
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    protected function renderPolygons(Map $map)
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
    protected function renderRectangles(Map $map)
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
    protected function renderCircles(Map $map)
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
    protected function renderGroundOverlays(Map $map)
    {
        $html = array();

        foreach($map->getGroundOverlays() as $groundOverlay)
            $html[] = $this->groundOverlayHelper->render($groundOverlay, $map);

        return implode('', $html);
    }
    
    /**
     * Renders the map javascript events
     * 
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    protected function renderEvents(Map $map)
    {
        $html = array();
        
        foreach($map->getEventManager()->getDomEvents() as $domEvent)
            $html[] = $this->eventHelper->renderDomEvent($domEvent);
        
        foreach($map->getEventManager()->getDomEventsOnce() as $domEventOnce)
            $html[] = $this->eventHelper->renderDomEventOnce($domEventOnce);
        
        foreach($map->getEventManager()->getEvents() as $event)
            $html[] = $this->eventHelper->renderEvent($event);
        
        foreach($map->getEventManager()->getEventsOnce() as $eventOnce)
            $html[] = $this->eventHelper->renderEventOnce($eventOnce);
        
        return implode('', $html);
    }
}
