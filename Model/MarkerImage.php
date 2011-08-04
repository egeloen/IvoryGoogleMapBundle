<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Marker image which describes a google map marker image
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerImage
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImage extends AbstractAsset
{
    /**
     * @var string URL of the marker image
     */
    protected $url = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Point Anchor of the marker image
     */
    protected $anchor = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Point Origin of the marker image
     */
    protected $origin = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Size Scaled size of the marker image
     */
    protected $scaledSize = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Size Size of the marker image
     */
    protected $size = null;
    
    /**
     * Create a marker image
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('marker_image_');
    }
    
    /**
     * Gets the url of the marker image
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Sets the url of the marker image
     *
     * @param string $url 
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     * Checks if the marker image has an anchor
     *
     * @return boolean TRUE if the marker image has an anchor else FALSE
     */
    public function hasAnchor()
    {
        return !is_null($this->anchor);
    }
    
    /**
     * Gets the anchor of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Point
     */
    public function getAnchor()
    {
        return $this->anchor;
    }
    
    /**
     * Sets the anchor of the marker image
     *
     * Available prototype:
     * 
     * public function setAnchor(integer x, integer y)
     * public function setAnchor(Ivory\GoogleMapBundle\Model\Point $anchor)
     */
    public function setAnchor()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            if($this->anchor === null)
                $this->anchor = new Point();
            
            $this->anchor->setX($args[0]);
            $this->anchor->setY($args[1]);
        }
        else if($args[0] instanceof Point)
            $this->anchor = $anchor;
        else
            throw new \InvalidArgumentException();
    }
    
    /**
     * Checks if the marker image has an origin
     *
     * @return boolean TRUE if the marker image has an origin else FALSE
     */
    public function hasOrigin()
    {
        return !is_null($this->origin);
    }
    
    /**
     * Gets the origin of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Point
     */
    public function getOrigin()
    {
        return $this->origin;
    }
    
    /**
     * Sets the origin of the marker image
     *
     * Available prototype:
     * 
     * public function setOrigin(integer x, integer y)
     * public function setOrigin(Ivory\GoogleMapBundle\Model\Point $anchor)
     */
    public function setOrigin()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            if($this->origin === null)
                $this->origin = new Point();
            
            $this->origin->setX($args[0]);
            $this->origin->setY($args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Point))
            $this->origin = $anchor;
        else
            throw new \InvalidArgumentException();
    }
    
    /**
     * Checks if the marker image has a scaled size else FALSE
     *
     * @return boolean TRUE if the marker image has a scaled size else FALSE
     */
    public function hasScaledSize()
    {
        return !is_null($this->scaledSize);
    }
    
    /**
     * Gets the scaled size of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Size
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }
    
    /**
     * Sets the scaled size of the marker image
     *
     * Available prototype:
     * 
     * public function setScaledSize(integer $width, integer $height, string $widthUnit = null, string $heightUnit = null)
     * public function setScaledSize(Size $scaledSize)
     */
    public function setScaledSize()
    {
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            if($this->scaledSize === null)
                $this->scaledSize = new Size($args[0], $args[1]);
            
            $this->scaledSize->setWidth($args[0]);
            $this->scaledSize->setHeight($args[1]);
            
            if(isset($args[2]) && is_string($args[2]) && isset($args[3]) && is_string($args[3]))
            {
                $this->scaledSize->setWidthUnit($args[2]);
                $this->scaledSize->setHeightUnit($args[3]);
            }
        }
        else if(isset($args[0]) && ($args[0] instanceof Size))
            $this->scaledSize = $scaledSize;
        else
            throw new \InvalidArgumentException();
    }
    
    /**
     * Checks if the marker image has a size
     *
     * @return boolean TRUE if the marker image has a size else FALSE
     */
    public function hasSize()
    {
        return !is_null($this->size);
    }
    
    /**
     * Gets the size of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Size
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * Sets the size of the marker image
     *
     * Available prototype:
     * 
     * public function setSize(integer $width, integer $height, string $widthUnit = null, string $heightUnit = null)
     * public function setSize(Size $scaledSize)
     */
    public function setSize()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_int($args[0]) && isset($args[1]) && is_int($args[1]))
        {
            if($this->size === null)
                $this->size = new Size($args[0], $args[1]);
            
            $this->size->setWidth($args[0]);
            $this->size->setHeight($args[1]);
            
            if(isset($args[2]) && is_string($args[2]) && isset($args[3]) && is_string($args[3]))
            {
                $this->size->setWidthUnit($args[2]);
                $this->size->setHeightUnit($args[3]);
            }
        }
        else if(isset($args[0]) && ($args[0] instanceof Size))
            $this->size = $scaledSize;
        else
            throw new \InvalidArgumentException();
    }
}
