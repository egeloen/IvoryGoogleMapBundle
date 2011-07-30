<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Polygon which describes a google map polygon
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polygon
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polygon extends AbstractAsset
{
    /**
     * @var array Coordinates of the polygone
     */
    protected $coordinates = array();

    /**
     * @var array Polygon options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#PolygonOptions
     */
    protected $options = array();

    /**
     * Create a polygon
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('polygon_');
    }

    /**
     * Gets the polygon coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Add a coordinate to the polygon
     *
     * Available prototype:
     * 
     * public function addCoordinate(Ivory\GoogleMapBundle\Model\Coordinate $coordinate)
     * public function addCoordinate(integer $latitude, integer $longitude, boolean $noWrap = true)
     */
    public function addCoordinate()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
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
     * Gets the polygon options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the polygon options
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
     * Get a specific polygon option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a sepcific polygon option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
