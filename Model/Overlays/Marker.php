<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Marker which describes a google map marker
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends AbstractAsset implements IExtendable
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Marker position
     */
    protected $position = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\MarkerImage Marker icon
     */
    protected $icon = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\MarkerImage Marker shadow
     */
    protected $shadow = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\MarkerShape Marker shape
     */
    protected $shape = null;

    /**
     * @var array Marker options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerOptions
     */
    protected $options = array();

    /**
     * @var Ivory\GoogleMapBundle\Model\Overlays\InfoWindow Info window at the marker position
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
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
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
     * public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position)
     * public function setPosition(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setPosition()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            $this->position->setLatitude($args[0]);
            $this->position->setLongitude($args[1]);

            if(isset($args[2]) && is_bool($args[2]))
                $this->position->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->position = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The position setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position)',
                ' - public function setPosition(double $latitude, double $longitude, boolean $noWrap = true)'));
    }
    
    /**
     * Checks if the marker has an icon
     *
     * @return boolean TRUE if the marker has an icon else FALSE
     */
    public function hasIcon()
    {
        return !is_null($this->icon);
    }

    /**
     * Gets the marker icon
     *
     * @return Ivory\GoogleMapBundle\Model\Overlays\MarkerImage
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the marker icon
     *
     * Available prototype:
     * 
     * public function setIcon(string $url)
     * public function setIcon(Ivory\GoogleMapBundle\Model\Overlays\MarkerImage $markerImage)
     */
    public function setIcon()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
        {
            if($this->icon === null)
                $this->icon = new MarkerImage();
            
            $this->icon->setUrl($args[0]);
        }
        else if(isset($args[0]) && ($args[0] instanceof MarkerImage))
            $this->icon = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The icon setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setIcon(string $url)',
                ' - public function setIcon(Ivory\GoogleMapBundle\Model\Overlays\MarkerImage $markerImage)'));
    }
    
    /**
     * Checks if the marker has a shadow
     *
     * @return boolean TRUE if the marker has a shadow else FALSE
     */
    public function hasShadow()
    {
        return !is_null($this->shadow);
    }

    /**
     * Gets the marker shadow
     *
     * @return Ivory\GoogleMapBundle\Model\Overlays\MarkerImage
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Sets the marker shadow
     *
     * Available prototype:
     * 
     * public function setShadow(string $url)
     * public function setShadow(Ivory\GoogleMapBundle\Model\Overlays\MarkerImage $markerImage)
     */
    public function setShadow()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]))
        {
            if($this->shadow === null)
                $this->shadow = new MarkerImage();
            
            $this->shadow->setUrl($args[0]);
        }
        else if(isset($args[0]) && ($args[0] instanceof MarkerImage))
            $this->shadow = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The shadow setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setShadow(string $url)',
                ' - public function setShadow(Ivory\GoogleMapBundle\Model\Overlays\MarkerImage $markerImage)'));
    }
    
    /**
     * Checks if the marker has a shape
     *
     * @return boolean TRUE if the marker has a shape else FALSE
     */
    public function hasShape()
    {
        return !is_null($this->shape);
    }
    
    /**
     * Gets the marker shape
     *
     * @return Ivory\GoogleMapBundle\Model\Overlays\MarkerShape
     */
    public function getShape()
    {
        return $this->shape;
    }
    
    /**
     * Sets the marker shape
     * 
     * Available prototype:
     * 
     * public function setShape(Ivory\GoogleMapBundle\Model\Overlays\MarkerShape $shape)
     * public function setShape(string $type, array $coordinates)
     */
    public function setShape()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_string($args[0]) && isset($args[1]) && is_array($args[1]))
        {
            if($this->shape === null)
                $this->shape = new MarkerShape();
            
            $this->shape->setType($args[0]);
            $this->shape->setCoordinates($args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof MarkerShape))
            $this->shape = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The shape setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setShape(Ivory\GoogleMapBundle\Model\Overlays\MarkerShape $shape)',
                ' - public function setShape(string $type, array $coordinates)'));
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
        foreach($options as $option => $value)
            $this->setOption($option, $value);
    }

    /**
     * Gets a specific marker option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        if(is_string($option))
            return isset($this->options[$option]) ? $this->options[$option] : null;
        else
            throw new \InvalidArgumentException('The option property of a marker must be a string value.');
    }

    /**
     * Sets a specific marker option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        if(is_string($option))
            $this->options[$option] = $value;
        else
            throw new \InvalidArgumentException('The option property of a marker must be a string value.');
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindow
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * Sets the info window
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\InfoWindow $infoWindow
     */
    public function setInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindow = $infoWindow;
    }
}
