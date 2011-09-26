<?php

namespace Ivory\GoogleMapBundle\Model;

use Ivory\GoogleMapBundle\Model\Base;
use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Map wich describes a google map
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends AbstractAsset
{   
    /**
     * @var string HTML container ID
     */
    protected $htmlContainerId = 'map_canvas';

    /**
     * @var boolean TRUE if the map autozoom else FALSE
     */
    protected $autoZoom = false;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Map center
     */
    protected $center = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound Map bound
     */
    protected $bound = null;

    /**
     * @var array Map options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapOptions
     */
    protected $mapOptions = array(
        'mapTypeId' => 'roadmap',
        'zoom'      => 3
    );

    /**
     * @var array Map stylesheet options
     */
    protected $stylesheetOptions = array(
        'width'  => '300px',
        'height' => '300px'
    );
    
    /**
     * @var Ivory\GoogleMapBundle\Model\EventManager Map event manager
     */
    protected $eventManager = null;

    /**
     * @var array Map markers
     */
    protected $markers = array();

    /**
     * @var array Map info windows
     */
    protected $infoWindows = array();

    /**
     * @var array Map polylines
     */
    protected $polylines = array();

    /**
     * @var array Map polygons
     */
    protected $polygons = array();

    /**
     * @var array Map rectangles
     */
    protected $rectangles = array();

    /**
     * @var array Map circles
     */
    protected $circles = array();

    /**
     * @var array Map ground overlays
     */
    protected $groundOverlays = array();

    /**
     * Create a map
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('map_');

        $this->center = new Base\Coordinate();
        $this->bound = new Base\Bound();
        $this->eventManager = new EventManager();
    }

    /**
     * Gets the map HTML container ID
     *
     * @return string
     */
    public function getHtmlContainerId()
    {
        return $this->htmlContainerId;
    }

    /**
     * Sets the map HTML container ID
     *
     * @param string $htmlContainerId
     */
    public function setHtmlContainerId($htmlContainerId)
    {
        $this->htmlContainerId = $htmlContainerId;
    }

    /**
     * Check if the map autozoom
     *
     * @return boolean TRUE if the map autozoom else FALSE
     */
    public function isAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * Sets if the map autozoom
     *
     * @param boolean $autoZoom TRUE if the map autozoom else FALSE
     */
    public function setAutoZoom($autoZoom)
    {
        $this->autoZoom = $autoZoom;
    }

    /**
     * Gets the map center
     *
     * @return Ivroy\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the map center
     * 
     * Available prototype:
     * 
     * public function setCenter(Ivory\GoogleMapBundle\Model\Base\Coordinate $center)
     * public function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setCenter()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->center->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Base\Coordinate))
            $this->center = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The center setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setCenter(Ivory\GoogleMapBundle\Model\Base\Coordinate $center)',
                ' - public function setCenter(double $latitude, double $longitude, boolean $noWrap = true)'));
    }
    
    /**
     * Gets the map bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the map bound
     *
     * Available prototype:
     * 
     * public function setBound(Ivory\GoogleMapBundle\Model\Base\Bound $bound)
     * public function setBount(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast)
     * public function setBound(double $southWestLatitude, double $southWestLongitude, double $northEastLatitude, double $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)
     */
    public function setBound()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && ($args[0] instanceof Base\Bound))
            $this->bound = $args[0];
        else if(isset($args[0]) && ($args[0] instanceof Base\Coordinate) && isset($args[1]) && ($args[1] instanceof Base\Coordinate))
        {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        }
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]) && isset($args[2]) && is_numeric($args[2]) && isset($args[3]) && is_numeric($args[3]))
        {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));
            
            if(isset($args[4]) && is_bool($args[4]))
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            
            if(isset($args[5]) && is_bool($args[5]))
                $this->bound->getNorthEast()->setNoWrap($args[5]);
        }
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The bound setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setBound(Ivory\GoogleMapBundle\Model\Base\Bound $bound)',
                ' - public function setBount(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast)',
                ' - public function setBound(double $southWestLatitude, double $southWestLongitude, double $northEastLatitude, double $northEastLongitude, boolean southWestNoWrap = true, boolean $northEastNoWrap = true)'));
    }

    /**
     * Gets the map options
     *
     * @return array
     */
    public function getMapOptions()
    {
        return $this->mapOptions;
    }

    /**
     * Sets the map options
     *
     * @param array $mapOptions
     */
    public function setMapOptions(array $mapOptions)
    {
        foreach($mapOptions as $mapOption => $value)
            $this->setMapOption($mapOption, $value);
    }

    /**
     * Gets a specific map option
     *
     * @param string $mapOption
     * @return mixed
     */
    public function getMapOption($mapOption)
    {
        if(is_string($mapOption))
            return isset($this->options[$mapOption]) ? $this->options[$mapOption] : null;
        else
            throw new \InvalidArgumentException('The map option property of a map must be a string value.');
    }

    /**
     * Sets a specific map option
     *
     * @param string $mapOption
     * @param mixed $value
     */
    public function setMapOption($mapOption, $value)
    {
        if(is_string($mapOption))
            $this->options[$mapOption] = $value;
        else
            throw new \InvalidArgumentException('The map option property of a map must be a string value.');
    }

    /**
     * Gets the stylesheet map options
     *
     * @return array
     */
    public function getStylesheetOptions()
    {
        return $this->stylesheetOptions;
    }

    /**
     * Sets the stylesheet map options
     *
     * @param array $stylesheetOptions
     */
    public function setStylesheetOptions(array $stylesheetOptions)
    {
        foreach($stylesheetOptions as $stylesheetOption => $value)
            $this->setStylesheetOption($stylesheetOption, $value);
    }

    /**
     * Gets a specific stylesheet map option
     *
     * @param string $stylesheetOption
     * @return mixed
     */
    public function getStylesheetOption($stylesheetOption)
    {
        if(is_string($stylesheetOption))
            return isset($this->stylesheetOptions[$stylesheetOption]) ? $this->stylesheetOptions[$stylesheetOption] : null;
        else
            throw new \InvalidArgumentException('The stylesheet option property of a map must be a string value.');
    }

    /**
     * Sets a specific stylesheet map option
     *
     * @param string $stylesheetOption
     * @param mixed $value
     */
    public function setStylesheetOption($stylesheetOption, $value)
    {
        if(is_string($stylesheetOption))
            $this->stylesheetOptions[$stylesheetOption] = $value;
        else
            throw new \InvalidArgumentException('The stylesheet option property of a map must be a string value.');
    }
    
    /**
     * Gets the map event manager
     *
     * @return Ivory\GoogleMapBundle\Model\EventManager
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
    
    /**
     * Sets the map event manager
     *
     * @param Ivory\GoogleMapBundle\Model\EventManager $eventManager 
     */
    public function setEventManager(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * Gets the map markers
     *
     * @return array
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Add a map marker
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Marker $marker
     */
    public function addMarker(Overlays\Marker $marker)
    {
        $this->markers[] = $marker;
        
        if($this->autoZoom)
            $this->bound->extend($marker);
    }

    /**
     * Gets the map info windows
     *
     * @return array
     */
    public function getInfoWindows()
    {
        return $this->infoWindows;
    }

    /**
     * Add a map info window
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\InfoWindow $infoWindow
     */
    public function addInfoWindow(Overlays\InfoWindow $infoWindow)
    {
        $this->infoWindows[] = $infoWindow;
        
        if($this->autoZoom)
            $this->bound->extend($infoWindow);
    }

    /**
     * Gets the map polylines
     *
     * @return Ivory\GoogleMapBundle\Model\Overlays\Polyline
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * Add a map polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Polyline $polyline
     */
    public function addPolyline(Overlays\Polyline $polyline)
    {
        $this->polylines[] = $polyline;
        
        if($this->autoZoom)
            $this->bound->extend($polyline);
    }

    /**
     * Gets the map polygons
     *
     * @return array
     */
    public function getPolygons()
    {
        return $this->polygons;
    }

    /**
     * Add a map polygon
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Polygon $polygon
     */
    public function addPolygon(Overlays\Polygon $polygon)
    {
        $this->polygons[] = $polygon;
        
        if($this->autoZoom)
            $this->bound->extend($polygon);
    }

    /**
     * Gets the map rectangles
     *
     * @return array
     */
    public function getRectangles()
    {
        return $this->rectangles;
    }

    /**
     * Add a map rectangle to the map
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Rectangle $rectangle
     */
    public function addRectangle(Overlays\Rectangle $rectangle)
    {
        $this->rectangles[] = $rectangle;
        
        if($this->autoZoom)
            $this->bound->extend($rectangle);
    }

    /**
     * Gets the map circles
     *
     * @return array
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * Add a circle to the map
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\Circle $circle
     */
    public function addCircle(Overlays\Circle $circle)
    {
        $this->circles[] = $circle;
        
        if($this->autoZoom)
            $this->bound->extend($circle);
    }

    /**
     * Gets the map ground overlays
     *
     * @return array
     */
    public function getGroundOverlays()
    {
        return $this->groundOverlays;
    }

    /**
     * Add a ground overlay to the map
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\GroupOverlay $groundOverlay
     */
    public function addGroundOverlay(Overlays\GroundOverlay $groundOverlay)
    {
        $this->groundOverlays[] = $groundOverlay;
        
        if($this->autoZoom)
            $this->bound->extend($groundOverlay);
    }
}
