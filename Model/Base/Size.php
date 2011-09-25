<?php

namespace Ivory\GoogleMapBundle\Model\Base;

/**
 * Size which describes a google map size
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Size
 * @author GeLo <geloen.eric@gmail.com>
 */
class Size 
{
    /**
     * @var double Width size
     */
    protected $width = null;
    
    /**
     * @var double Height size
     */
    protected $height = null;
    
    /**
     * @var string Width unit size
     */
    protected $widthUnit = null;
    
    /**
     * @var string Height unit size
     */
    protected $heightUnit = null;
    
    /**
     * Create a size
     *
     * @param double $width
     * @param double $height
     * @param string $widthUnit
     * @param string $heightUnit 
     */
    public function __construct($width, $height, $widthUnit = null, $heightUnit = null)
    {
        $this->setWidth($width);
        $this->setHeight($height);
        
        $this->setWidthUnit($widthUnit);
        $this->setHeightUnit($heightUnit);
    }
    
    /**
     * Checks if the size has units
     *
     * @return boolean TRUE if the size has units else FALSE
     */
    public function hasUnits()
    {
        return !is_null($this->widthUnit) && !is_null($this->heightUnit);
    }
    
    /**
     * Gets the width size
     *
     * @return double
     */
    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * Sets the width size
     *
     * @param double $width 
     */
    public function setWidth($width)
    {
        if(is_numeric($width))
            $this->width = $width;
        else
            throw new \InvalidArgumentException('The width of a size must be a numeric value.');
    }
    
    /**
     * Gets the height size
     *
     * @return double
     */
    public function getHeight()
    {
        return $this->height;
    }
    
    /**
     * Sets the height size
     *
     * @param double $height 
     */
    public function setHeight($height)
    {
        if(is_numeric($height))
            $this->height = $height;
        else
            throw new \InvalidArgumentException('The height of a size must be a numeric value.');
    }
    
    /**
     * Gets the width unit size
     *
     * @return string
     */
    public function getWidthUnit()
    {
        return $this->widthUnit;
    }
    
    /**
     * Set sthe width unit size
     *
     * @param string $widthUnit 
     */
    public function setWidthUnit($widthUnit)
    {
        if(is_string($widthUnit))
            $this->widthUnit = $widthUnit;
        else
            throw new \InvalidArgumentException('The width unit of a size must be a string value.');
    }
    
    /**
     * Gets the height unit size
     *
     * @return string 
     */
    public function getHeightUnit()
    {
        return $this->heightUnit;
    }
    
    /**
     * Set sthe height unit size
     *
     * @param string $heightUnit 
     */
    public function setHeightUnit($heightUnit)
    {
        if(is_string($heightUnit))
            $this->heightUnit = $heightUnit;
        else
            throw new \InvalidArgumentException('The height unit of a size must be a string value.');
    }
}
