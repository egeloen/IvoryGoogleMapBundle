<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * Directions response wraps the directions results & the response status
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsResponse
{
    /**
     * @var array Directions routes
     */
    protected $routes = array();
    
    /**
     * @var string Directions results status
     */
    protected $status = null;
    
    /**
     * Create a directions response
     *
     * @param array $routes
     * @param string $status 
     */
    public function __construct(array $routes, $status)
    {
        $this->setRoutes($routes);
        $this->setStatus($status);
    }
    
    /**
     * Gets the directions routes
     *
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
    
    /**
     * Sets the directions routes
     *
     * @param array $routes 
     */
    public function setRoutes(array $routes)
    {
        $this->routes = array();
        
        foreach($routes as $route)
            $this->addRoute($route);
    }
    
    /**
     * Add a directions route
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute $route 
     */
    public function addRoute(DirectionsRoute $route)
    {
        $this->routes[] = $route;
    }
    
    /**
     * Gets the directions results status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Sets the directions results status
     *
     * @param string $status 
     */
    public function setStatus($status)
    {
        if(in_array($status, DirectionsStatus::getDirectionsStatus()))
            $this->status = $status;
        else
            throw new \InvalidArgumentException('The directions response status can only be : '.implode(', ', DirectionsStatus::getDirectionsStatus()));
    }
}
