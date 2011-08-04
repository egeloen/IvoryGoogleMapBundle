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
     * @param Ivory\GoogleMapBundle\Model\Point $anchor 
     */
    public function setAnchor(Point $anchor)
    {
        $this->anchor = $anchor;
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
     * @param Ivory\GoogleMapBundle\Model\Point $origin 
     */
    public function setOrigin(Point $origin)
    {
        $this->origin = $origin;
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
     * @param Ivory\GoogleMapBundle\Model\Size $scaledSize 
     */
    public function setScaledSize(Size $scaledSize)
    {
        $this->scaledSize = $scaledSize;
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
     * @param Ivory\GoogleMapBundle\Model\Size $size 
     */
    public function setSize(Size $size)
    {
        $this->size = $size;
    }
}
