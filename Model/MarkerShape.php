<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Marker shape which describes a google map marker shape
 * 
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerShape
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShape extends AbstractAsset
{
    /**
     * @var string Maker shape type (circle | poly | rect)
     */
    protected $type = null;
    
    /**
     * @var array Marker shape coordinates
     */
    protected $coordinates = array();
    
    /**
     * Create a marker shape
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('marker_shape_');
    }
    
    /**
     * Gets the marker shape type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Sets the marker shape type
     *
     * @param string $type 
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * Gets the marker shape coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    
    /**
     * Sets the marker shape coordinates
     *
     * @param array $coordinates 
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }
    
    /**
     * Add a coordinate to the marker shape
     *
     * @param integer $coordinate 
     */
    public function addCoordinate($coordinate)
    {
        $this->coordinates[] = $coordinate;
    }
}

?>
