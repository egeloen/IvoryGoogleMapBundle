<?php

namespace Ivory\GoogleMapBundle\Model;

use Ivory\GoogleMapBundle\Model\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMapBundle\Model\Base;
use Ivory\GoogleMapBundle\Model\Controls;
use Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Map wich describes a google map
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends AbstractJavascriptVariableAsset
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
        'mapTypeId' => MapTypeId::ROADMAP,
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
     * @var Ivory\GoogleMapBundle\Model\Controls\MapTypeControl Map type control
     */
    protected $mapTypeControl = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl Overview map control
     */
    protected $overviewMapControl = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\PanControl Map pan control
     */
    protected $panControl = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\RotateControl Map rotate control
     */
    protected $rotateControl = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\ScaleControl Map scale control
     */
    protected $scaleControl = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Controls\StreetViewControl Map street view control
     */
    protected $streetViewControl = null;
    
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
        if(is_string($htmlContainerId))
            $this->htmlContainerId = $htmlContainerId;
        else
            throw new \InvalidArgumentException('The html container id of a map must be a string value.');
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
        if(is_bool($autoZoom))
            $this->autoZoom = $autoZoom;
        else
            throw new \InvalidArgumentException('The auto zoom of a map must be a boolean value.');
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
            $this->bound->setSouthWest(new Base\Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Base\Coordinate($args[2], $args[3]));
            
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
            return isset($this->mapOptions[$mapOption]) ? $this->mapOptions[$mapOption] : null;
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
            $this->mapOptions[$mapOption] = $value;
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
     * Gets the map type control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\MapTypeControl
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }
    
    /**
     * Sets the map type control
     * 
     * Available prototype :
     * 
     * public function setMapTypeControl(Ivory\GoogleMapBundle\Model\Controls\MapTypeControl $mapTypeControl = null)
     * public function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)
     */
    public function setMapTypeControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_array($args[0]) && isset($args[1]) && is_string($args[1]) && isset($args[2]) && is_string($args[2]))
        {
            if($this->mapTypeControl === null)
                $this->mapTypeControl = new Controls\MapTypeControl();
            
            $this->mapTypeControl->setMapTypeIds($args[0]);
            $this->mapTypeControl->setControlPosition($args[1]);
            $this->mapTypeControl->setMapTypeControlStyle($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Controls\MapTypeControl))
            $this->mapTypeControl = $args[0];
        else if(!isset($args[0]))
            $this->mapTypeControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The map type control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setMapTypeControl(Ivory\GoogleMapBundle\Model\Controls\MapTypeControl $mapTypeControl = null)',
                ' - public function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)'));
    }
    
    /**
     * Gets the overview map control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl
     */
    public function getOverviewMapControl()
    {
        return $this->overviewMapControl;
    }
    
    /**
     * Sets the overview map control
     * 
     * Available prototype :
     * 
     * - public function setOverviewMapControl(Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl $overviewMapControl = null)
     * - public function setOverviewMapControl(boolean $opened)
     */
    public function setOverviewMapControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_bool($args[0]))
        {
            if($this->overviewMapControl === null)
                $this->overviewMapControl = new Controls\OverviewMapControl();
            
            $this->overviewMapControl->setOpened($args[0]);
        }
        else if(isset($args[0]) && ($args[0]) instanceof Controls\OverviewMapControl)
            $this->overviewMapControl = $args[0];
        else if(!isset($args[0]))
            $this->overviewMapControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The overview map control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setOverviewMapControl(Ivory\GoogleMapBundle\Model\Controls\OverviewMapControl $overviewMapControl = null)',
                ' - public function setOverviewMapControl(boolean $opened)'));
    }
    
    /**
     * Gets the map pan control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\PanControl
     */
    public function getPanControl()
    {
        return $this->panControl;
    }
    
    /**
     * Sets the map pan control
     * 
     * Available prototype :
     * 
     * - public function setPanControl(Ivory\GoogleMapBundle\Model\Controls\PanControl $panControl = null)
     * - public function setPanControl(string $controlPosition)
     */
    public function setPanControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
        {
            if($this->panControl === null)
                $this->panControl = new Controls\PanControl();
            
            $this->panControl->setControlPosition($args[0]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Controls\PanControl))
            $this->panControl = $args[0];
        else if(!isset($args[0]))
            $this->panControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The pan control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setPanControl(Ivory\GoogleMapBundle\Model\Controls\PanControl $panControl = null)',
                ' - public function setPanControl(string $controlPosition)'));
    }
    
    /**
     * Gets the map rotate control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\RotateControl
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }
    
    /**
     * Sets the map rotate control
     * 
     * Available prototype :
     * 
     * - public function setRotateControl(Ivory\GoogleMapBundle\Model\Controls\RotateControl $rotateControl = null)'
     * - public function setRotateControl(string $controlPosition)
     */
    public function setRotateControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
        {
            if($this->rotateControl === null)
                $this->rotateControl = new Controls\RotateControl();
            
            $this->rotateControl->setControlPosition($args[0]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Controls\RotateControl))
            $this->rotateControl = $args[0];
        else if(!isset($args[0]))
            $this->rotateControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The rotate control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setRotateControl(Ivory\GoogleMapBundle\Model\Controls\RotateControl $rotateControl = null)',
                ' - public function setRotateControl(string $controlPosition)'));
    }
    
    /**
     * Gets the map scale control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\ScaleControl
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }
    
    /**
     * Sets the map scale control
     * 
     * Available prototype :
     * 
     * - public function setScaleControl(Ivory\GoogleMapBundle\Model\Controls\ScaleControl $scaleControl = null)
     * - public function setScaleControl(string $controlPosition, string $scaleControlStyle)
     */
    public function setScaleControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]) && isset($args[1]) && is_string($args[1]))
        {
            if($this->scaleControl === null)
                $this->scaleControl = new Controls\ScaleControl();
            
            $this->scaleControl->setControlPosition($args[0]);
            $this->scaleControl->setScaleControlStyle($args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Controls\ScaleControl))
            $this->scaleControl = $args[0];
        else if(!isset($args[0]))
            $this->scaleControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The scale control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setScaleControl(Ivory\GoogleMapBundle\Model\Controls\ScaleControl $scaleControl = null)',
                ' - public function setScaleControl(string $controlPosition, string $scaleControlStyle)'));
    }
    
    /**
     * Gets the map street view control
     *
     * @return Ivory\GoogleMapBundle\Model\Controls\StreetViewControl
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }
    
    /**
     * Sets the map street view control
     * 
     * Available prototype:
     * 
     * - public function setStreetViewControl(Ivory\GoogleMapBundle\Model\Controls\StreetViewControl $streetViewControl = null)
     * - public function setStreetViewControl(string $controlPosition)
     */
    public function setStreetViewControl()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
        {
            if($this->streetViewControl === null)
                $this->streetViewControl = new Controls\StreetViewControl();
            
            $this->streetViewControl->setControlPosition($args[0]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Controls\StreetViewControl))
            $this->streetViewControl = $args[0];
        else if(!isset($args[0]))
            $this->streetViewControl = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The street view control setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setStreetViewControl(Ivory\GoogleMapBundle\Model\Controls\StreetViewControl $streetViewControl = null)',
                ' - public function setStreetViewControl(string $controlPosition)'));
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
