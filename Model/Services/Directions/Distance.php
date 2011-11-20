<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * Distance which describes a google map distance
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Distance
 * @author GeLo <geloen.eric@gmail.com>
 */
class Distance 
{
    /**
     * @var string A string representation of the distance value
     */
    protected $text = null;
    
    /**
     * @var double The distance in meters
     */
    protected $value = null;
    
    /**
     * Creates a distance
     *
     * @param string $text
     * @param double $value 
     */
    public function __construct($text, $value)
    {
        $this->setText($text);
        $this->setValue($value);
    }
    
    /**
     * Gets the string representation of the distance value
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Sets the string representation of the distance value
     *
     * @param string $text 
     */
    public function setText($text)
    {
        if(is_string($text))
            $this->text = $text;
        else
            throw new \InvalidArgumentException('The distance text must be a string value.');
    }
    
    /**
     * Gets the distance in meters
     *
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the distance in meters
     *
     * @param double $value 
     */
    public function setValue($value)
    {
        if(is_numeric($value))
            $this->value = $value;
        else
            throw new \InvalidArgumentException('The distance value must be a numeric value.');
    }
}
