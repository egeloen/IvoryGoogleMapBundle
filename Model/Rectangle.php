<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Rectangle which describes a google map rectangle
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Rectangle extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Bound Rectangle bound
     */
    protected $bound = null;

    /**
     * @var array Rectangle options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#RectangleOptions
     */
    protected $options = array();

    /**
     * Create a rectangle
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('rectangle_');

        $this->bound = new Bound();
        $this->bound->setNorthEast(new Coordinate());
        $this->bound->setSouthWest(new Coordinate());
    }

    /**
     * Gets the rectangle bound
     *
     * @return Ivory\GoogleMapBundle\Model\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the rectangle bound
     *
     * @param Ivory\GoogleMapBundle\Model\Bound $bound
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * Gets the rectangle options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the rectangle options
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
     * Gets a specific rectangle option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific rectangle option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
