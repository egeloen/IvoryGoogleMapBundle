<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Polyline which describes a google map polyline
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polyline
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline extends AbstractOptionsAsset implements IExtendable
{
    /**
     * @var array Coordinates of the polyline
     */
    protected $coordinates = array();

    /**
     * Create a polyline
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('polyline_');
    }
    
    /**
     * Checks if the polyline has coordinates
     *
     * @return boolean TRUE if the polyline has coordinates else FALSE
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * Gets the polyline coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
    
    /**
     * Sets the polyline coordinates
     *
     * @param array $coordinates 
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = array();
        
        foreach($coordinates as $coordinate)
            $this->addCoordinate($coordinate);
    }

    /**
     * Add a coordinate to the polyline
     *
     * Available prototype:
     * 
     * public function addCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate)
     * public function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function addCoordinate()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if(isset($args[2]) && is_bool($args[2]))
                $this->coordinates[] = new Coordinate($args[0], $args[1], $args[2]);
            else
                $this->coordinates[] = new Coordinate($args[0], $args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->coordinates[] = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The coordinate adder arguments is invalid.',
                'The available prototypes are :',
                ' - public function addCoordinate(Ivory\GoogleMapBundle\Model\Base\Coordinate $coordinate)',
                ' - public function addCoordinate(double $latitude, double $longitude, boolean $noWrap = true)'));
    }
}
