<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Marker which describes a google map marker
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate Marker position
     */
    protected $position = null;

    /**
     * @var string Marker icon
     */
    protected $icon = null;

    /**
     * @var string Marker shadow
     */
    protected $shadow = null;

    /**
     * @var array Marker options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerOptions
     */
    protected $options = array();

    /**
     * @var Ivory\GoogleMapBundle\Model\InfoWindow
     */
    protected $infoWindow = null;

    /**
     * Create a marker
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('marker_');
        
        $this->position = new Coordinate();
    }

    /**
     * Gets the marker position
     *
     * @return Ivory\GoogleMapBundle\Model\Coordinate
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the marker position
     *
     * Available prototype:
     * 
     * public function setPosition(Ivory\GoogleMapBundle\Model\Coordinate $position)
     * public function setPosition(integer $latitude, integer $longitude, boolean $noWrap = true)
     */
    public function setPosition()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            $this->position->setLatitude($args[0]);
            $this->position->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->position->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->position = $args[0];
        else
            throw new \InvalidArgumentException();
    }

    /**
     * Gets the marker icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the marker icon
     *
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * Gets the marker shadow
     *
     * @return string
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Sets the marker shadow
     *
     * @param string $shadow
     */
    public function setShadow($shadow)
    {
        $this->shadow = $shadow;
    }

    /**
     * Gets the marker options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the marker options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge(
            $this->options,
            $options
        );
    }

    /**
     * Gets a specific marker option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific marker option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
    
    /**
     * Check if the marker has an info window
     *
     * @return boolean TRUE if the marker has an info window else FALSE
     */
    public function hasInfoWindow()
    {
        return $this->infoWindow !== null;
    }

    /**
     * Gets the info window
     *
     * @return \Ivory\GoogleMapBundle\Model\InfoWindow
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * Sets the info window
     *
     * @param Ivory\GoogleMapBundle\Model\InfoWindow $infoWindow
     */
    public function setInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindow = $infoWindow;
    }
}
