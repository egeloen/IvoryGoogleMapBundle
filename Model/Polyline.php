<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Polyline which describes a google map polyline
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polyline
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline extends AbstractAsset
{
    /**
     * @var array Coordinates of the polyline
     */
    protected $coordinates = array();

    /**
     * @var array Polyline options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PolylineOptions
     */
    protected $options = array();

    /**
     * Create a polyline
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('polyline_');
    }

    /**
     * Gets the polyline coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    
    /**
     * Sets the polyline coordinates
     *
     * @param array $coordinates 
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * Add a coordinate to the polyline
     *
     * Available prototype:
     * 
     * public function addCoordinate(Ivory\GoogleMapBundle\Model\Coordinate $coordinate)
     * public function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function addCoordinate()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(isset($args[2]) && is_bool($args[2]))
                $this->coordinates[] = new Coordinate($args[0], $args[1], $args[2]);
            else
                $this->coordinates[] = new Coordinate($args[0], $args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->coordinates[] = $args[0];
        else
            throw new \InvalidArgumentException();
    }

    /**
     * Gets the polyline options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the polyline options
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
     * Gets a specific polyline option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific polyline option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
