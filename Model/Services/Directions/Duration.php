<?php

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

/**
 * Duration which describes a google map duration
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Duration
 * @author GeLo <geloen.eric@gmail.com>
 */
class Duration 
{
    /**
     * @var string A string representation of the duration value
     */
    protected $text = null;
    
    /**
     * @var double The duration in minutes
     */
    protected $value = null;
    
    /**
     * Creates a duration
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
     * Gets the string representation of the duration value
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Sets the string representation of the duration value
     *
     * @param string $text 
     */
    public function setText($text)
    {
        if(is_string($text))
            $this->text = $text;
        else
            throw new \InvalidArgumentException('The duration text must be a string value.');
    }
    
    /**
     * Gets the duration in minutes
     *
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the duration in minutes
     *
     * @param double $value 
     */
    public function setValue($value)
    {
        if(is_numeric($value))
            $this->value = $value;
        else
            throw new \InvalidArgumentException('The duration value must be a numeric value.');
    }
}
