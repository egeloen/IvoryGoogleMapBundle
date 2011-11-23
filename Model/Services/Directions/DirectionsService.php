<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Services\AbstractService;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

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
     * Available prototypes:
     * - public function route(string $origin, string $destination)
     * - public function route(Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest $request)
     */
    public function route()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]) && isset($args[1]) && is_string($args[1]))
        {
            $directionsRequest = new DirectionsRequest();
            $directionsRequest->setOrigin($args[0]);
            $directionsRequest->setDestination($args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof DirectionsRequest))
            $directionsRequest = $args[0];
        else
            throw new \InvalidArgumentException('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The route arguments are invalid.',
                'The available prototypes are:',
                '- public function route(string $origin, string $destination)',
                '- public function route(Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequest $request)'
            );
        
        if(!$directionsRequest->isValid())
            throw new \InvalidArgumentException('The directions request is not valid. It needs at least an origin and a destination.'.PHP_EOL.'If you add waypoint to the directions request, it needs at least a location.');
        
        $response = $this->browser->get($this->generateUrl($directionsRequest));
        $directionsResponse = $this->buildDirectionsResponse($this->parse($response->getContent()));
        
        return $directionsResponse;
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
        else if($directionsRequest->hasAvoidHighways() && $directionsRequest->getAvoidHighways())
            $httpQuery['avoid'] = 'highways';
        
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
    
    /**
     * Parse & normalize the directions API result response
     *
     * @param string $response
     * @return stdClass 
     */
    protected function parse($response)
    {
        if($this->format == 'json')
            return $this->parseJSON($response);
        else
            return $this->parseXML($response);
    }
    
    /**
     * Parse & normalize a JSON directions API result response
     *
     * @param string $response
     * @return stdClass 
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }
    
    /**
     * Parse & normalize an XML directions API result response
     *
     * @todo Finish implementation
     * @param string $response 
     * @return stdClass
     */
    protected function parseXML($response)
    {
        throw new \Exception('Actually, the xml format is not supported.');
    }
    
    /**
     * Build directions response with the normalized directions API results given
     *
     * @param stdClass $directionsResponse
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsResponse
     */
    protected function buildDirectionsResponse(\stdClass $directionsResponse)
    {
        $routes = $this->buildDirectionsRoutes($directionsResponse->routes);
        $status = $directionsResponse->status;

        return new DirectionsResponse($routes, $status);
    }
    
    /**
     * Build directions routes with the normalized directions API routes given
     *
     * @param stdClass $directionsRoutes
     * @return array
     */
    protected function buildDirectionsRoutes(array $directionsRoutes)
    {
        $results =  array();
        
        foreach($directionsRoutes as $directionsRoute)
            $results[] = $this->buildDirectionsRoute($directionsRoute);
        
        return $results;
    }
    
    /**
     * Build directions route with the normalized directions API route given
     *
     * @param stdClass $directionsRoute
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRoute 
     */
    protected function buildDirectionsRoute(\stdClass $directionsRoute)
    {
        $bound = new Bound();
        $bound->setNorthEast($directionsRoute->bounds->northeast->lat, $directionsRoute->bounds->northeast->lng);
        $bound->setSouthWest($directionsRoute->bounds->southwest->lat, $directionsRoute->bounds->southwest->lng);
        
        $copyrights = $directionsRoute->copyrights;
        $directionsLegs = $this->buildDirectionsLegs($directionsRoute->legs);
        $overviewPolyline = new EncodedPolyline($directionsRoute->overview_polyline->points);
        $summary = $directionsRoute->summary;
        $warnings = $directionsRoute->warnings;
        $waypointOrder = $directionsRoute->waypoint_order;
        
        return new DirectionsRoute($bound, $copyrights, $directionsLegs, $overviewPolyline, $summary, $warnings, $waypointOrder);
    }
    
    /**
     * Build directions legs with the normalized directions API legs given
     *
     * @param array $directionsLegs
     * @return array
     */
    protected function buildDirectionsLegs(array $directionsLegs)
    {
        $results =  array();
        
        foreach($directionsLegs as $directionsLeg)
            $results[] = $this->buildDirectionsLeg($directionsLeg);
        
        return $results;
    }
    
    /**
     * Build directions leg with the normalized directions API leg given
     *
     * @param \stdClass $directionsLeg
     * @return ivory\GoogleMapBundle\Model\Services\Directions\DirectionsLeg 
     */
    protected function buildDirectionsLeg(\stdClass $directionsLeg)
    {
        $distance = new Distance($directionsLeg->distance->text, $directionsLeg->distance->value);
        $duration = new Duration($directionsLeg->duration->text, $directionsLeg->duration->value);
        $endAddress = $directionsLeg->end_address;
        $endLocation = new Coordinate($directionsLeg->end_location->lat, $directionsLeg->end_location->lng);
        $startAddress = $directionsLeg->start_address;
        $startLocation = new Coordinate($directionsLeg->start_location->lat, $directionsLeg->start_location->lng);
        $steps = $this->buildDirectionsSteps($directionsLeg->steps);
        
        return new DirectionsLeg($distance, $duration, $endAddress, $endLocation, $startAddress, $startLocation, $steps);
    }
    
    /**
     * Build directions steps with the normalized directions API steps given
     *
     * @param array $directionsSteps
     * @return array
     */
    protected function buildDirectionsSteps(array $directionsSteps)
    {
        $results =  array();
        
        foreach($directionsSteps as $directionsStep)
            $results[] = $this->buildDirectionsStep($directionsStep);
        
        return $results;
    }
    
    /**
     * Build directions step with the normalized directions API step given
     *
     * @param \stdClass $directionsStep
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsStep 
     */
    protected function buildDirectionsStep(\stdClass $directionsStep)
    {
        $distance = new Distance($directionsStep->distance->text, $directionsStep->distance->value);
        $duration = new Duration($directionsStep->duration->text, $directionsStep->duration->value);
        $endLocation = new Coordinate($directionsStep->end_location->lat, $directionsStep->end_location->lng);
        $instructions = $directionsStep->html_instructions;
        $encodedPolyline = new EncodedPolyline($directionsStep->polyline->points);
        $startLocation = new Coordinate($directionsStep->start_location->lat, $directionsStep->start_location->lng);
        $travelMode = $directionsStep->travel_mode;
        
        return new DirectionsStep($distance, $duration, $endLocation, $instructions, $encodedPolyline, $startLocation, $travelMode);
    }
}
