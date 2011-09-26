<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Circle which describes a google map circle
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Circle
 * @author GeLo <geloen.eric@gmail.com>
 */
class Circle extends AbstractAsset implements IExtendable
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Circle center
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
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the circle center
     * 
     * Available prototype:
     * 
     * public function setCenter(Ivory\GoogleMapBundle\Model\Base\Coordinate $center)
     * public function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setCenter()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->center->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->center = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The center setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setCenter(Ivory\GoogleMapBundle\Model\Base\Coordinate $center)', 
                ' - public function setCenter(double $latitude, double $longitude, boolean $noWrap = true)'));
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
        if(is_numeric($radius))
            $this->radius = $radius;
        else
            throw new \InvalidArgumentException('The radius of a circle must be a numeric value.');
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
        foreach($options as $option => $value)
            $this->setOption($option, $value);
    }

    /**
     * Gets a specific circle option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        if(is_string($option))
            return isset($this->options[$option]) ? $this->options[$option] : null;
        else
            throw new \InvalidArgumentException('The option property of a circle must be a string value.');
    }

    /**
     * Sets a specific circle option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        if(is_string($option))
            $this->options[$option] = $value;
        else
            throw new \InvalidArgumentException('The option property of a circle must be a string value.');
    }
}
