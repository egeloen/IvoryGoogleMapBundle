<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Polyline which describes a google map polyline
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polyline
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline extends AbstractAsset implements IExtendable
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
     * Reset the coordinates
     */
    protected function resetCoordinates()
    {
        $this->coordinates = array();
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
        $this->resetCoordinates();
        
        foreach($this->coordinates as $coordinate)
            $this->addCoordinate($coordinate);
    }

    /**
     * Add a coordinate to the polyline
     *
     * Available prototype:
     * 
     * public function addCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate)
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
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The coordinate adder arguments is invalid.',
                'The available prototypes are :',
                ' - public function addCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate)',
                ' - public function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)'));
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
        foreach($options as $option => $value)
            $this->setOption($option, $value);
    }

    /**
     * Gets a specific polyline option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        if(is_string($option))
            return isset($this->options[$option]) ? $this->options[$option] : null;
        else
            throw new \InvalidArgumentException('The option property of a polyline must be a string value.');
    }

    /**
     * Sets a specific polyline option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        if(is_string($option))
            $this->options[$option] = $value;
        else
            throw new \InvalidArgumentException('The option property of a polyline must be a string value.');
    }
}
