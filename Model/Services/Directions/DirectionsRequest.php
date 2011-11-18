<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * DirectionsRequest represents a google map directions request
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequest 
{
    /**
     * @var boolean TRUE, the Directions service will use highways if possible else FALSE
     */
    protected $avoidHighways = null;
    
    /**
     * @var boolean TRUE, the Directions service will use tolls if possible else FALSE
     */
    protected $avoidTolls = null;
    
    /**
     * @var string|Ivory\GoogleMapBundle\Model\Base\Coordinate Directions request destination
     */
    protected $destination = null;
    
    /**
     * @var boolean TRUE, the DirectionService will attempt to re-order the supplied intermediate waypoints to minimize overall cost of the route else FALSE
     */
    protected $optimizeWaypoints = null;
    
    /**
     * @var string|Ivory\GoogleMapBundle\Model\Base\Coordinate Directions request origin
     */
    protected $origin = null;
    
    /**
     * @var boolean TRUE if route alternatives should be provided else FALSE
     */
    protected $provideRouteAlternatives = null;
    
    /**
     * @var string Region code used as a bias for geocoding requests
     */
    protected $region = null;
    
    /**
     * @var string Directions request travel mode
     */
    protected $travelMode = null;
    
    /**
     * @var string Directionsrequest unit system
     */
    protected $unitSystem = null;
    
    /**
     * @var array Array of intermediate waypoints
     */
    protected $waypoints = array();
    
    /**
     * @var boolean TRUE if the request has a sensor else FALSE
     */
    protected $sensor = false;
    
    /**
     * Checks if the directions request has an avoid hightways flag
     *
     * @return boolean TRUE if the directions request has an avoid hightways flag else FALSE
     */
    public function hasAvoidHightways()
    {
        return !is_null($this->avoidHighways);
    }
    
    /**
     * Checks if the directions request avoid hightways
     *
     * @return boolean TRUE if the directions request avoids hightways else FALSE
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }
    
    /**
     * Sets if the the directions request avoids hightways
     *
     * @param boolean $avoidHighways TRUE if the directions request avoids hightways else FALSE
     */
    public function setAvoidHighways($avoidHighways = null)
    {
        if(is_bool($avoidHighways) || is_null($avoidHighways))
            $this->avoidHighways = $avoidHighways;
        else
            throw new \InvalidArgumentException('The directions request avoid hightways flag must be a boolean value.');
    }
    
    /**
     * Checks if the directions request has an avoid tolls flag
     *
     * @return boolean TRUE if the directions request has an avoid tolls flag else FALSE
     */
    public function hasAvoidTolls()
    {
        return !is_null($this->avoidTolls);
    }
    
    /**
     * Checks if the directions request avoid tolls
     *
     * @return boolean TRUE if the directions request avoids tolls else FALSE
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }
    
    /**
     * Sets if the the directions request avoids tolls
     *
     * @param boolean $avoidTolls TRUE if the directions request avoids tolls else FALSE
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        if(is_bool($avoidTolls) || is_null($avoidTolls))
            $this->avoidTolls = $avoidTolls;
        else
            throw new \InvalidArgumentException('The directions request avoid tolls flag must be a boolean value.');
    }
    
    /**
     * Checks if the directions request has a destination
     *
     * @return boolean TRUE if the directions request has a destination else FALSE
     */
    public function hasDestination()
    {
        return !is_null($this->destination);
    }
    
    /**
     * Gets the directions request destination
     *
     * @return string|Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getDestination()
    {
        return $this->destination;
    }
    
    /**
     * Sets the directions request destination
     * 
     * Available prototypes:
     * - public function setDestination(string $destination)
     * - public function setDestination(double $latitude, double $longitude, boolean $noWrap)
     * - public function setDestination(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)
     */
    public function setDestination()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
            $this->destination = $args[0];
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(is_null($this->destination))
                $this->destination = new Coordinate();
            
            $this->destination->setLatitude($args[0]);
            $this->destination->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->destination->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->destination = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The destination setter arguments are invalid.',
                'The available prototypes are :',
                ' - public function setDestination(string $destination)',
                ' - public function setDestination(double $latitude, double $longitude, boolean $noWrap)',
                ' - public function setDestination(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)'));
    }
    
    /**
     * Checks if the directions request has the optimize waypoints flag
     *
     * @return boolean TRUE if the directions request has the optimize waypoints flag else FALSE
     */
    public function hasOptimizeWaypoints()
    {
        return !is_null($this->optimizeWaypoints);
    }
    
    /**
     * Checks if the directions request optimizes waypoints
     *
     * @return boolean TRUE if the directions request optmizes waypoints else FALSE
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }
    
    /**
     * Sets if the directions request optimizes waypoints
     *
     * @param boolean $optimizeWaypoints TRUE if the directions request optimizes waypoints else FALSE
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null)
    {
        if(is_bool($optimizeWaypoints) || is_null($optimizeWaypoints))
            $this->optimizeWaypoints = $optimizeWaypoints;
        else
            throw new \InvalidArgumentException('The directions request optimize waypoints flag must be a boolean value.');
    }
    
    /**
     * Checks if the directions request has an origin
     *
     * @return boolean TRUE if the directions request has an origin else FALSE
     */
    public function hasOrigin()
    {
        return !is_null($this->origin);
    }
    
    /**
     * Gets the directions request origin
     *
     * @return string|Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getOrigin()
    {
        return $this->origin;
    }
    
    /**
     * Sets the directions request origin
     * 
     * Available prototypes:
     * - public function setOrigin(string $destination)
     * - public function setOrigin(double $latitude, double $longitude, boolean $noWrap)
     * - public function setOrigin(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)
     */
    public function setOrigin()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
            $this->origin = $args[0];
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(is_null($this->origin))
                $this->origin = new Coordinate();
            
            $this->origin->setLatitude($args[0]);
            $this->origin->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->origin->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->origin = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The origin setter arguments are invalid.',
                'The available prototypes are :',
                ' - public function setOrigin(string $destination)',
                ' - public function setOrigin(double $latitude, double $longitude, boolean $noWrap)',
                ' - public function setOrigin(Ivory\GoogleMapBundle\Model\Base\Coordinate $destination)'));
    }
    
    /**
     * Checks if the directions request has a provide route alternatives flag
     *
     * @return boolean TRUE if the directions request has a provide route alternative flag else FALSE
     */
    public function hasProvideRouteAlternatives()
    {
        return !is_null($this->provideRouteAlternatives);
    }
    
    /**
     * Checks if the directions request provides route alternatives
     *
     * @return boolean TRUE if the directions request provides route alternatives else FALSE
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }
    
    /**
     * Sets if the directions request provides route alternatives
     *
     * @param boolean $provideRouteAlternatives TRUE if the directions request provides route alternatives else FALSE
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null)
    {
        if(is_bool($provideRouteAlternatives) || is_null($provideRouteAlternatives))
            $this->provideRouteAlternatives = $provideRouteAlternatives;
        else
            throw new \InvalidArgumentException('The directions request provide route alternatives flag must be a boolean value.');
    }
    
    /**
     * Checks if the directions request has a region
     *
     * @return boolean TRUE if the directions request has a region else FALSE
     */
    public function hasRegion()
    {
        return !is_null($this->region);
    }
    
    /**
     * Gets the directions request region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }
    
    /**
     * Sets the directions request region
     *
     * @param string $region
     */
    public function setRegion($region = null)
    {
        if((is_string($region) && (strlen($region) == 2)) || is_null($region))
            $this->region = $region;
        else
            throw new \InvalidArgumentException('The directions request region must be a string with two characters.');
    }
    
    /**
     * Checks if the directions request has a travel mode
     *
     * @return boolean TRUE if the directions request has a travel mode else FALSE
     */
    public function hasTravelMode()
    {
        return !is_null($this->travelMode);
    }
    
    /**
     * Gets the directionsrequest travel mode
     *
     * @return string
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }
    
    /**
     * Sets the directions request travel mode
     *
     * @param string $travelMode 
     */
    public function setTravelMode($travelMode = null)
    {
        if(in_array($travelMode, TravelMode::getTravelModes()) || is_null($travelMode))
            $this->travelMode = $travelMode;
        else
            throw new \InvalidArgumentException(sprintf('The directions request travel mode can only be : %s', implode(', ', TravelMode::getTravelModes())));
    }
    
    /**
     * Checks if the directions request has a unit system
     *
     * @return boolean TRUE if the directions request has a unit system else FALSE
     */
    public function hasUnitSystem()
    {
        return !is_null($this->unitSystem);
    }
    
    /**
     * Gets the directions request unit system
     *
     * @return string
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }
    
    /**
     * Sets  the directions request unit system
     *
     * @param string $unitSystem 
     */
    public function setUnitSystem($unitSystem = null)
    {
        if(in_array($unitSystem, UnitSystem::getUnitSystems()) || is_null($unitSystem))
            $this->unitSystem = $unitSystem;
        else
            throw new \InvalidArgumentException(sprintf('The directions request unit system can only be : %s', implode(', ', UnitSystem::getUnitSystems())));
    }
    
    /**
     * Checks if the directions request has waypoints
     *
     * @return boolean TRUE if the directions requesthas waypoints else FALSE
     */
    public function hasWaypoints()
    {
        return !empty($this->waypoints);
    }
    
    /**
     * Gets the directions request waypoints
     *
     * @return array
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }
    
    /**
     * Sets the directions request waypoints
     *
     * @param array $waypoints 
     */
    public function setWaypoints(array $waypoints = array())
    {
        $this->waypoints = array();
        
        foreach(array_values($waypoints) as $waypoint)
        {
            if(is_array($waypoint))
            {
                $latitude = $waypoint[0];
                $lonitude = $waypoint[1];
                isset($waypoint[2]) ? $noWrap = $waypoint[2] : null;
                
                $this->addWaypoint($latitude, $lonitude, $noWrap);
            }
            else
                $this->addWaypoint($waypoint);
        }
    }
    
    /**
     * Adds a waypoint to the directions request
     *
     * Available prototypes:
     * - public function addWaypoint(Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsWaypoint $waypoint)
     * - public function addWaypoint(string $location)
     * - public function addWaypoint(double $latitude, double $longitude, boolean $noWrap)
     * - public function addWaypoint(Ivory\GoogleMapBundle\Model\Base\Coordinate $location) 
     */
    public function addWaypoint()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && ($args[0] instanceof DirectionsWaypoint))
            $this->waypoints[] = $args[0];
        else if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            $waypoint = new DirectionsWaypoint();
            $waypoint->setLocation($args[0], $args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $waypoint->getLocation()->setNoWrap($args[2]);
            
            $this->waypoints[] = $waypoint;
        }
        else if(isset($args[0]) && (is_string($args[0]) || ($args[0] instanceof Coordinate)))
        {
            $waypoint = new DirectionsWaypoint();
            $waypoint->setLocation($args[0]);
            
            $this->waypoints[] = $waypoint;
        }
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The origin setter arguments are invalid.',
                'The available prototypes are :',
                ' - public function addWaypoint(Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsWaypoint $waypoint)',
                ' - public function addWaypoint(string $location)',
                ' - public function addWaypoint(double $latitude, double $longitude, boolean $noWrap)',
                ' - public function addWaypoint(Ivory\GoogleMapBundle\Model\Base\Coordinate $location)'));
    }
    
    /**
     * Checks if the directions request has a sensor
     *
     * @return boolean TRUE if the directions request has a sensor else FALSE
     */
    public function hasSensor()
    {
        return $this->sensor;
    }
    
    /**
     * Sets the directions request sensor
     *
     * @param boolean $sensor TRUE if the directions request has a sensor else FALSE
     */
    public function setSensor($sensor)
    {
        if(is_bool($sensor))
            $this->sensor = $sensor;
        else
            throw new \InvalidArgumentException('The directions request sensor flag must be a boolean value.');
    }
    
    /**
     * Checks if the directions request is valid
     *
     * @return boolean TRUE if the directions request is valid else FALSE
     */
    public function isValid()
    {
        $isValid = $this->hasDestination() && $this->hasOrigin();
        
        for($i = 0 ; $isValid && ($i < count($this->waypoints)) ; $i++)
            $isValid = $this->waypoints[$i]->isValid();
        
        return $isValid;
    }
}
