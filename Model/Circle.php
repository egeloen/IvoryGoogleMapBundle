<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Circle which describes a google map circle
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate Circle center
     */
    protected $center = null;

    /**
     * @var float Circle radius
     */
    protected $radius = 1;

    /**
     * @var array Circle options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#CircleOptions
     */
    protected $options = array();

    /**
     * Create a circle
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('circle_');

        $this->center = new Coordinate();
    }

    /**
     * Gets the circle center
     *
     * @return Ivory\GoogleMapBundle\Model\Coordinate
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the circle center
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $center 
     */
    public function setCenter(Coordinate $center)
    {
        $this->center = $center;
    }

    /**
     * Gets the circle radius
     *
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Sets the circle radius
     *
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * Gets the circle options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the circle options
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
     * Gets a specific circle option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific circle option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
