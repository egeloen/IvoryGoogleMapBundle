<?php

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

use Geocoder\Provider\AbstractProvider;
use Geocoder\Provider\ProviderInterface;

use Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest;
use Ivory\GoogleMapBundle\Model\Services\Geocoding\Result;

use Ivory\GoogleMapBundle\Model\Base\Bound;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Ivory google map provider
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var string Service API url
     */
    protected $url = 'http://maps.googleapis.com/maps/api/geocode';
    
    /**
     * @var boolean TRUE if the service uses HTTPS else FALSE
     */
    protected $https = false;
    
    /**
     * @var string Format used by the service
     */
    protected $format = 'json';
    
    /**
     * Gets the service API url according to the https flag
     *
     * @return string
     */
    public function getUrl()
    {
        if($this->isHttps())
            return str_replace('http://', 'https://', $this->url);
        else
            return $this->url;
    }
    
    /**
     * Sets the service API url
     *
     * @param string $url 
     */
    public function setUrl($url)
    {
        if(is_string($url))
            $this->url = $url;
        else
            throw new \InvalidArgumentException('The service url must be a string value.');
    }
    
    /**
     * Checks if the service uses HTTPS
     *
     * @return boolean TRUE if the service uses HTTPS else FALSE
     */
    public function isHttps()
    {
        return $this->https;
    }
    
    /**
     * Sets the service HTTPS flag
     *
     * @param boolean $https TRUE if the service uses HTTPS else FALSE
     */
    public function setHttps($https)
    {
        if(is_bool($https))
            $this->https = $https;
        else
            throw new \InvalidArgumentException('The service https flag must be a boolean value.');
    }
    
    /**
     * Gets the service format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
    
    /**
     * Sets the service format
     *
     * @param string $format 
     */
    public function setFormat($format)
    {
        $availableFormats = array('json', 'xml');
        
        if(in_array($format, $availableFormats))
            $this->format = $format;
        else
            throw new \InvalidArgumentException('The service format can only be : '.implode(', ', $availableFormats));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getGeocodedData($request)
    {
        if(is_string($request))
        {
            $geocoderRequest = new GeocoderRequest();
            $geocoderRequest->setAddress($request);
        }
        else if($request instanceof GeocoderRequest)
            $geocoderRequest = $request;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The geolocate argument is invalid.',
                'The available prototypes are :',
                ' - public function geocode(string $address)',
                ' - public function geocode(Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest $request)'
            ));

        if(!$geocoderRequest->isValid())
            throw new \InvalidArgumentException('The geocoder request is not valid. It needs at least an address or a coordinate.');
        
        $url = $this->generateUrl($geocoderRequest);
        $response = $this->getAdapter()->getContent($url);
        $normalizedResponse = $this->parse($response);
        
        return $this->buildGeocoderResponse($normalizedResponse);
    }

    /**
     * {@inheritDoc}
     */
    public function getReversedData(array $coordinates)
    {
        $request = new GeocoderRequest();
        $request->setCoordinate($coordinates[0], $coordinates[1]);
        
        return $this->getGeocodedData($request);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
    
    /**
     * Generates geocoding URL API according to the request
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequest $geocoderRequest
     * @return string
     */
    protected function generateUrl(GeocoderRequest $geocoderRequest)
    {
        $httpQuery = array();
        
        if($geocoderRequest->hasAddress())
            $httpQuery['address'] = $geocoderRequest->getAddress();
        else
            $httpQuery['latlng'] = sprintf('%s,%s',
                $geocoderRequest->getCoordinate()->getLatitude(),
                $geocoderRequest->getCoordinate()->getLongitude()
            );
        
        if($geocoderRequest->hasBound())
            $httpQuery['bound'] = sprintf('%s,%s|%s,%s',
                $geocoderRequest->getBound()->getSouthWest()->getLatitude(),
                $geocoderRequest->getBound()->getSouthWest()->getLongitude(),
                $geocoderRequest->getBound()->getNorthEast()->getLatitude(),
                $geocoderRequest->getBound()->getNorthEast()->getLongitude()
            );
        
        if($geocoderRequest->hasRegion())
            $httpQuery['region'] = $geocoderRequest->getRegion();
        
        if($geocoderRequest->hasLanguage())
            $httpQuery['language'] = $geocoderRequest->getLanguage();
        
        $httpQuery['sensor'] = $geocoderRequest->hasSensor() ? 'true' : 'false';
        
        return sprintf('%s/%s?%s', 
            $this->getUrl(),
            $this->getFormat(),
            http_build_query($httpQuery)
        );
    }
    
    /**
     * Parse & normalize the geocoding API result response
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
     * Parse & normalize a JSON geocoding API result response
     *
     * @param string $response
     * @return stdClass 
     */
    protected function parseJSON($response)
    {
        return json_decode($response);
    }
    
    /**
     * Parse & normalize an XML geocoding API result response
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
     * Build geocoder results with the normalized geocoding API results given
     *
     * @param stdClass $geocoderResponse
     * @return Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResponse
     */
    protected function buildGeocoderResponse(\stdClass $geocoderResponse)
    {
        $results = array();
        foreach($geocoderResponse->results as $geocoderResult)
            $results[] = $this->buildGeocoderResult($geocoderResult);

        $status = $geocoderResponse->status;

        return new Result\GeocoderResponse($results, $status);
    }
    
    /**
     * Build geocoder result with the normalized geocoding result given
     *
     * @param stdClass $geocoderResult
     * @return Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderResult 
     */
    protected function buildGeocoderResult(\stdClass $geocoderResult)
    {
        $addressComponents = $this->buildGeocoderAddressComponents($geocoderResult->address_components);
        $formattedAddress = $geocoderResult->formatted_address;
        $geometry = $this->buildGeocoderGeometry($geocoderResult->geometry);
        $types = $geocoderResult->types;
        $partialMatch = isset($geocoderResult->partial_match) ? $geocoderResult->partial_match : null;
        
        return new Result\GeocoderResult($addressComponents, $formattedAddress, $geometry, $types, $partialMatch);
    }
    
    /**
     * Build gecoder address components with the given normalized geocoding address components given
     *
     * @param array $geocoderAddressComponents
     * @return array 
     */
    protected function buildGeocoderAddressComponents(array $geocoderAddressComponents)
    {
        $results = array();
        
        foreach($geocoderAddressComponents as $geocoderAddressComponent)
            $results[] = $this->buildGeocoderAddressComponent($geocoderAddressComponent);
        
        return $results;
    }
    
    /**
     * Build geocoder addresser component with the normalized geocoding address component given
     *
     * @param stdClass $geocoderAddressComponent
     * @return GeocoderAddressComponent 
     */
    protected function buildGeocoderAddressComponent(\stdClass $geocoderAddressComponent)
    {
        $longName = $geocoderAddressComponent->long_name;
        $shortName = $geocoderAddressComponent->short_name;
        $types = $geocoderAddressComponent->types;
        
        return new Result\GeocoderAddressComponent($longName, $shortName, $types);
    }
    
    /**
     * Build geocoder geometry with the given normalized geocoding geometry given
     *
     * @param \stdClass $geocoderGeometry
     * @return Ivory\GoogleMapBundle\Model\Services\Geocoding\Result\GeocoderGeometry 
     */
    protected function buildGeocoderGeometry(\stdClass $geocoderGeometry)
    {
        $location = new Coordinate($geocoderGeometry->location->lat, $geocoderGeometry->location->lng);
        $locationType = $geocoderGeometry->location_type;
        
        $viewport = new Bound();
        $viewport->setNorthEast($geocoderGeometry->viewport->northeast->lat, $geocoderGeometry->viewport->northeast->lng);
        $viewport->setSouthWest($geocoderGeometry->viewport->southwest->lat, $geocoderGeometry->viewport->southwest->lng);
        
        if(isset($geocoderGeometry->bounds))
        {
            $bound = new Bound();
            $bound->setNorthEast($geocoderGeometry->bounds->northeast->lat, $geocoderGeometry->bounds->northeast->lng);
            $bound->setSouthWest($geocoderGeometry->bounds->southwest->lat, $geocoderGeometry->bounds->southwest->lng);
        }
        else
            $bound = null;
        
        return new Result\GeocoderGeometry($location, $locationType, $viewport, $bound);
    }
}
