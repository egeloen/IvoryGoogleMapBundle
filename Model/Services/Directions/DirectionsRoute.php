<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\Base\Bound;

/**
 * DirectionsRoute which describes a google map route
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRoute
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRoute 
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Bound Route bound
     */
    protected $bound = null;
    
    /**
     * @var string Copyrights text to be displayed for this route
     */
    protected $copyrights = null;
    
    /**
     * @var array Route legs
     */
    protected $legs = array();
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline Route overview encoded polyline
     */
    protected $overviewPolyline = null;
    
    /**
     * @var string Route summary
     */
    protected $summary = null;
    
    /**
     * @var array Route warnings
     */
    protected $warnings = array();
    
    /**
     * @var array Route waypoint order
     */
    protected $waypointOrder = array();
    
    /**
     * Creates a directions route
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound 
     * @param string $copyrights
     * @param array $legs 
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline $overviewPolyline
     * @param string $summary
     * @param array $warnings
     * @param array $waypointOrder
     */
    public function __construct(Bound $bound, $copyrights, array $legs, EncodedPolyline $overviewPolyline, $summary, array $warnings, array $waypointOrder)
    {
        $this->setBound($bound);
        $this->setCopyrights($copyrights);
        $this->setLegs($legs);
        $this->setOverviewPolyline($overviewPolyline);
        $this->setSummary($summary);
        $this->setWarnings($warnings);
        $this->setWaypointOrder($waypointOrder);
    }
    
    /**
     * Gets the route bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }
    
    /**
     * Sets the route bound
     *
     * @param Ivory\GoogleMapBundle\Model\Base\Bound $bound 
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }
    
    /**
     * Gets the directions route copyrights
     *
     * @return string
     */
    public function getCopyrights()
    {
        return $this->copyrights;
    }
    
    /**
     * Sets the directions route copyrights
     *
     * @param string $copyrights 
     */
    public function setCopyrights($copyrights)
    {
        if(is_string($copyrights))
            $this->copyrights = $copyrights;
        else
            throw new \InvalidArgumentException('The directions route copyrights must be a string value.');
    }
    
    /**
     * Gets the route legs
     *
     * @return array
     */
    public function getLegs()
    {
        return $this->legs;
    }
    
    /**
     * Sets the route legs
     *
     * @param array $legs 
     */
    public function setLegs(array $legs)
    {
        $this->legs = array();
        
        foreach($legs as $leg)
            $this->addLeg($leg);
    }
    
    /**
     * Add a leg to the route
     * 
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsLeg
     */
    public function addLeg(DirectionsLeg $leg)
    {
        $this->legs[] = $leg;
    }
    
    /**
     * Gets the route overview polyline
     *
     * @return Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline
     */
    public function getOverviewPolyline()
    {
        return $this->overviewPolyline;
    }
    
    /**
     * Sets the route overview polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Services\Directions\EncodedPolyline $overviewPolyline 
     */
    public function setOverviewPolyline(EncodedPolyline $overviewPolyline)
    {
        $this->overviewPolyline = $overviewPolyline;
    }
    
    /**
     * Gets the route summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
    
    /**
     * Sets the route summary
     *
     * @param string $summary 
     */
    public function setSummary($summary)
    {
        if(is_string($summary))
            $this->summary = $summary;
        else
            throw new \InvalidArgumentException('The directions route summary must be a string value.');
    }
    
    /**
     * Gets the route warnings
     *
     * @return array
     */
    public function getWarnings()
    {
       return $this->warnings;
    }
    
    /**
     * Sets the route warnings
     *
     * @param array $warnings 
     */
    public function setWarnings(array $warnings)
    {
        $this->warnings = array();
        
        foreach($warnings as $warning)
            $this->addWarning($warning);
    }
    
    /**
     * Add a warning to the route
     *
     * @param string $warning 
     */
    public function addWarning($warning)
    {
        if(is_string($warning))
            $this->warnings[] = $warning;
        else
            throw new \InvalidArgumentException('The directions route warning must be a string value.');
    }
    
    /**
     * Gets the route waypoint order
     *
     * @return array
     */
    public function getWaypointOrder()
    {
        return $this->waypointOrder;
    }
    
    /**
     * Sets the routes waypoint order
     *
     * @param array $waypointOrder 
     */
    public function setWaypointOrder(array $waypointOrder)
    {
        $this->waypointOrder = array();
        
        foreach($waypointOrder as $order)
            $this->addWaypointOrder($order);
    }
    
    /**
     * Add a waypoint order to the route
     *
     * @param integer $order 
     */
    public function addWaypointOrder($order)
    {
        if(is_int($order))
            $this->waypointOrder[] = $order;
        else
            throw new \InvalidArgumentException('The routes waypoint order must be an integer value.');
    }
}
