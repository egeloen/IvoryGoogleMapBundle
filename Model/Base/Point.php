<?php

namespace Ivory\GoogleMapBundle\Model\Base;

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
     * Creates a point
     *
     * @param double $x X coordinate
     * @param double $y Y coordinate
     */
    public function __construct($x = 0, $y = 0)
    {
        $this->setX($x);
        $this->setY($y);
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
        if(is_numeric($x))
            $this->x = $x;
        else
            throw new \InvalidArgumentException('The x coordinate of a point must be a numeric value.');
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
        if(is_numeric($y))
            $this->y = $y;
        else
            throw new \InvalidArgumentException('The y coordinate of a point must be a numeric value.');
    }
}
