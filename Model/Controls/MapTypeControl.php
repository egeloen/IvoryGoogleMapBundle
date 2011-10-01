<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

use Ivory\GoogleMapBundle\Model\MapTypeId;
use Ivory\GoogleMapBundle\Model\Controls\ControlPosition;
use Ivory\GoogleMapBundle\Model\Controls\MapTypeControlStyle;

/**
 * Map type control options describes a google map type control options
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControl
{
    /**
     * @var array Map type ids
     */
    protected $mapTypeIds = array(
        MapTypeId::ROADMAP,
        MapTypeId::SATELLITE
    );
    
    /**
     * @var string Control position
     */
    protected $controlPosition = ControlPosition::TOP_LEFT;
    
    /**
     * @var string Map type control style
     */
    protected $mapTypeControlStyle = MapTypeControlStyle::DEFAULT_;
    
    /**
     * Gets the map type ids
     *
     * @return array
     */
    public function getMapTypeIds()
    {
        return $this->mapTypeIds;
    }
    
    /**
     * Sets the map type ids
     *
     * @param array $mapTypeIds 
     */
    public function setMapTypeIds($mapTypeIds)
    {
        $this->mapTypeIds = array();
        
        foreach($mapTypeIds as $mapTypeId)
            $this->addMapTypeId($mapTypeId);
    }
    
    /**
     * Add a map type id
     *
     * @param string $mapTypeId 
     */
    public function addMapTypeId($mapTypeId)
    {
        if(in_array($mapTypeId, MapTypeId::getMapTypeIds()))
            $this->mapTypeIds[] = $mapTypeId;
        else
            throw new \InvalidArgumentException(sprintf('The map type id of a map type control can only be : %s.', implode(', ', MapTypeId::getMapTypeIds())));
    }
    
    /**
     * Gets the control position
     *
     * @return string
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }
    
    /**
     * Sets the control position
     *
     * @param string $controlPosition 
     */
    public function setControlPosition($controlPosition)
    {
        if(in_array($controlPosition, ControlPosition::getControlPositions()))
            $this->controlPosition = $controlPosition;
        else
            throw new \InvalidArgumentException(sprintf('The control position of a map type control can only be : %s.'), implode(', ', ControlPosition::getControlPositions()));
    }
    
    /**
     * Gets the map type control style
     *
     * @return string
     */
    public function getMapTypeControlStyle()
    {
        return $this->mapTypeControlStyle;
    }
    
    /**
     * Sets the map type control style
     *
     * @param type $mapTypeControlStyle 
     */
    public function setMapTypeControlStyle($mapTypeControlStyle)
    {
        if(in_array($mapTypeControlStyle, MapTypeControlStyle::getMapTypeControlStyles()))
            $this->mapTypeControlStyle = $mapTypeControlStyle;
        else
            throw new \InvalidArgumentException(sprintf('The map type control style of a map type control can only be : %s.', implode(', ', MapTypeControlStyle::getMapTypeControlStyles())));
    }
}
