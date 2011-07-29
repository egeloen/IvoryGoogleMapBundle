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
     * Add a coordinate to the polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $coordinate
     */
    public function addCoordinate(Coordinate $coordinate)
    {
        $this->coordinates[] = $coordinate;
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
