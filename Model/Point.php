<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Point which describes a google map point
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Point
 * @author GeLo <geloen.eric@gmail.com>
 */
class Point
{
    /**
     * @var double X coordinate
     */
    protected $x = 0;
    
    /**
     * @var double Y coordinate
     */
    protected $y = 0;
    
    /**
     * Create a point
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }
    
    /**
     * Gets the x coordinate
     *
     * @return double
     */
    public function getX()
    {
        return $this->x;
    }
    
    /**
     * Sets the x coordinate
     *
     * @param double $x 
     */
    public function setX($x)
    {
        $this->x = $x;
    }
    
    /**
     * Gets the y coordinate
     *
     * @return double
     */
    public function getY()
    {
        return $this->y;
    }
    
    /**
     * Sets the y coordinate
     *
     * @param double $y 
     */
    public function setY($y)
    {
        $this->y = $y;
    }
}
