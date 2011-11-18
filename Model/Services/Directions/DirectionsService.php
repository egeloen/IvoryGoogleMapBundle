<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\AbstractService;

/**
 * Google map directions service
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsService extends AbstractService
{
    /**
     * Creates a directions service
     */
    public function __construct()
    {
        parent::__construct('http://maps.googleapis.com/maps/api/directions');
    }
    
    /**
     * Routes the given request
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest $directionsRequest 
     */
    public function route(DirectionsRequest $directionsRequest)
    {
        if(!$directionsRequest->isValid())
            throw new \InvalidArgumentException('The directions request is not valid. It needs at least an origin and a destination.'.PHP_EOL.'If you add waypoint to the directions request, it needs at least a location.');
        
        $response = $this->browser->get($this->generateUrl($directionsRequest));
        
        // DEBUG
        echo'<pre>';var_dump($response);echo'</pre>';die;
    }
    
    /**
     * Generates directions URL API according to the request
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest $directionsRequest
     * @return string
     */
    protected function generateUrl(DirectionsRequest $directionsRequest)
    {
        $httpQuery = array();
        
        if(is_string($directionsRequest->getOrigin()))
            $httpQuery['origin'] = $directionsRequest->getOrigin();
        else
            $httpQuery['origin'] = sprintf('%s,%s',
                $directionsRequest->getOrigin()->getLatitude(),
                $directionsRequest->getOrigin()->getLongitude()
            );
        
        if(is_string($directionsRequest->getDestination()))
            $httpQuery['destination'] = $directionsRequest->getDestination();
        else
            $httpQuery['destination'] = sprintf('%s,%s',
                $directionsRequest->getDestination()->getLatitude(),
                $directionsRequest->getDestination()->getLongitude()
            );
        
        if($directionsRequest->hasWaypoints())
        {
            $waypoints = array();
            
            if($directionsRequest->hasOptimizeWaypoints() && $directionsRequest->getOptimizeWaypoints())
                $waypoints[] = 'optimize:true';
            
            foreach($directionsRequest->getWaypoints() as $waypoint)
            {
                if(is_string($waypoint->getLocation()))
                    $waypoints[] = $waypoint->getLocation();
                else
                    $waypoints[] = sprintf('%s,%s',
                        $waypoint->getLocation()->getLatitude(),
                        $waypoint->getLocation()->getLongitude()
                    );
            }
            
            $httpQuery['waypoints'] = implode('|', $waypoints);
        }
        
        if($directionsRequest->hasTravelMode())
            $httpQuery['mode'] = strtolower($directionsRequest->getTravelMode());
        
        if($directionsRequest->hasProvideRouteAlternatives())
            $httpQuery['alternatives'] = $directionsRequest->getProvideRouteAlternatives() ? 'true' : 'false';
        
        if($directionsRequest->hasAvoidTolls() && $directionsRequest->getAvoidTolls())
            $httpQuery['avoid'] = 'tolls';
        else if($directionsRequest->hasAvoidHightways() && $directionsRequest->getAvoidHighways())
            $httpQuery['avoid'] = 'hightways';
        
        if($directionsRequest->hasUnitSystem())
            $httpQuery['units'] = strtolower($directionsRequest->getUnitSystem());
        
        if($directionsRequest->hasRegion())
            $httpQuery['region'] = $directionsRequest->getRegion();
        
        $httpQuery['sensor'] = $directionsRequest->hasSensor() ? 'true' : 'false';
            
        return sprintf('%s/%s?%s', 
            $this->getUrl(),
            $this->getFormat(),
            http_build_query($httpQuery)
        );
    }
}
