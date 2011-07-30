<?php

namespace Ivory\GoogleMapBundle\Model;

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
     * @var Ivory\GoogleMapBundle\Model\Coordinate Map center
     */
    protected $center = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Bound Map bound
     */
    protected $bound = null;

    /**
     * @var array Map options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapOptions
     */
    protected $mapOptions = array(
        'mapTypeId' => 'roadmap',
        'zoom'      => 10
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

        $this->center = new Coordinate();
        $this->bound = new Bound();
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
     * @return Ivroy\GoogleMapBundle\Model\Coordinate
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
     * public function setCenter(Ivory\GoogleMapBundle\Model\Coordinate $center)
     * public function setCenter(integer $longitude, integer $latitude, boolean $noWrap = true)
     */
    public function setCenter()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->center->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->center = $args[0];
        else
            throw new \InvalidArgumentException();
    }
    
    /**
     * Gets the map bound
     *
     * @return Ivory\GoogleMapBundle\Model\Bound
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
     * public function setBound(Ivory\GoogleMapBundle\Model\Bound $bound)
     * public function setBount(Ivory\GoogleMapBundle\Model\Coordinate $southWest, Ivory\GoogleMapBundle\Model\Coordinate $northEast)
     * public function setBound(integer $southWestLongitude, integer $southWestLatitude, integer $northEastLongitude, integer $northEastLatitude)
     */
    public function setBound()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && ($args[0] instanceof Bound))
            $this->bound = $args[0];
        else if(isset($args[0]) && ($args[0] instanceof Coordinate) && isset($args[1]) && ($args[1] instanceof Coordinate))
        {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        }
        else if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]) && isset($args[2]) && is_int($args[2]) && isset($args[3]) && is_int($args[3]))
        {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));
        }
        else
            throw new \InvalidArgumentException();
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
        $this->mapOptions = array_merge(
            $this->mapOptions,
            $mapOptions
        );
    }

    /**
     * Gets a specific map option
     *
     * @param string $mapOption
     * @return mixed
     */
    public function getMapOption($mapOption)
    {
        return isset($this->mapOptions[$mapOption]) ? $this->mapOptions[$mapOption] : null;
    }

    /**
     * Sets a specific map option
     *
     * @param string $mapOption
     * @param mixed $value
     */
    public function setMapOption($mapOption, $value)
    {
        $this->mapOptions[$mapOption] = $value;
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
        $this->stylesheetOptions = array_merge(
            $this->stylesheetOptions,
            $stylesheetOptions
        );
    }

    /**
     * Gets a specific stylesheet map option
     *
     * @param string $stylesheetOption
     * @return mixed
     */
    public function getStylesheetOption($stylesheetOption)
    {
        return isset($this->stylesheetOptions[$stylesheetOption]) ? $this->stylesheetOptions[$stylesheetOption] : null;
    }

    /**
     * Sets a specific stylesheet map option
     *
     * @param string $stylesheetOption
     * @param mixed $value
     */
    public function setStylesheetOption($stylesheetOption, $value)
    {
        $this->stylesheetOptions[$stylesheetOption] = $value;
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
     * @param Ivory\GoogleMapBundle\Model\Marker $marker
     */
    public function addMarker(Marker $marker)
    {
        $this->markers[] = $marker;
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
     * @param Ivory\GoogleMapBundle\Model\InfoWindow $infoWindow
     */
    public function addInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindows[] = $infoWindow;
    }

    /**
     * Gets the map polylines
     *
     * @return Ivory\GoogleMapBundle\Model\Polyline
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * Add a map polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Polyline $polyline
     */
    public function addPolyline(Polyline $polyline)
    {
        $this->polylines[] = $polyline;
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
     * @param Ivory\GoogleMapBundle\Model\Polygon $polygon
     */
    public function addPolygon(Polygon $polygon)
    {
        $this->polygons[] = $polygon;
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
     * @param Ivory\GoogleMapBundle\Model\Rectangle $rectangle
     */
    public function addRectangle(Rectangle $rectangle)
    {
        $this->rectangles[] = $rectangle;
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
     * @param Ivory\GoogleMapBundle\Model\Circle $circle
     */
    public function addCircle(Circle $circle)
    {
        $this->circles[] = $circle;
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
     * @param Ivory\GoogleMapBundle\Model\GroupOverlay $groundOverlay
     */
    public function addGroundOverlay(GroundOverlay $groundOverlay)
    {
        $this->groundOverlays[] = $groundOverlay;
    }
}
