<?php

namespace Ivory\GoogleMapBundle\Model\Controls;

/**
 * An overview map control describes a google map overview control
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#OverviewMapControlOptions
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControl 
{
    /**
     * @var boolean TRUE if the overview map control is opened else FALSE
     */
    protected $opened = false;
    
    /**
     * Create an overview map control
     */
    public function __construct()
    {
        
    }
    
    /**
     * Checks if the overview map control is opened else FALSE
     *
     * @return boolean TRUE if the overview map control is opened else FALSE
     */
    public function isOpened()
    {
        return $this->opened;
    }
    
    /**
     * Sets if the overview map control is opened
     *
     * @param boolean $opened TRUE if the overview map control is opened else FALSE
     */
    public function setOpened($opened)
    {
        if(is_bool($opened))
            $this->opened = $opened;
        else
            throw new \InvalidArgumentException('The opened property of an overview map control must be a boolean value.');
    }
}
