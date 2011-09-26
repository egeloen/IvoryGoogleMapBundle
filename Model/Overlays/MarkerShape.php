<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

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
    protected $type = 'poly';
    
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
     * The allowing marker shape type are : circle, poly & rect
     *
     * @param string $type 
     */
    public function setType($type)
    {
        switch(strtolower($type))
        {
            case 'circle':
            case 'poly':
            case 'rect':
                $this->type = $type;
            break;
        
            default:
                throw new \InvalidArgumentException(sprintf('The type of a marker shape can only be : %s.', implode(', ', array('circle', 'poly', 'rect'))));
            break;
        }
        
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
        switch(strtolower($this->type))
        {
            case 'circle':
                if((count($coordinates) == 3) && is_numeric($coordinates[0]) && is_numeric($coordinates[1]) && is_numeric($coordinates[2]))
                    $this->coordinates = $coordinates;
                else
                    throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s',
                        'The coordinates setter arguments is invalid if the marker shape type is circle.',
                        'The available prototype is : public function setCoordinates(array(double $x, double $y, double $r))'));
            break;

            case 'poly':
                if((count($coordinates) % 2) == 0)
                {
                    foreach($coordinates as $coordinate)
                    {
                        if(!is_numeric($coordinate))
                            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s',
                                'The coordinates setter arguments is invalid if the marker shape type is poly.',
                                'The available prototype is : public function setCoordinates(array(double $x1, double $y1, ..., double $xn, double $yn))'));
                    }

                    $this->coordinates = $coordinates;
                }
                else
                    throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s',
                        'The coordinates setter arguments is invalid if the marker shape type is poly.',
                        'The available prototype is : public function setCoordinates(array(double $x1, double $y1, ..., double $xn, double $yn))'));
            break;

            case 'rect':
                if((count($coordinates) == 4) && is_numeric($coordinates[0]) && is_numeric($coordinates[1]) && is_numeric($coordinates[2]) && is_numeric($coordinates[3]))
                    $this->coordinates = $coordinates;
                else
                    throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s',
                        'The coordinates setter arguments is invalid if the marker shape type is rect.',
                        'The available prototype is : public function setCoordinates(array(double $x1, double $y1, double $x2, double $y2))'));
            break;

            default:
                throw new \InvalidArgumentException(sprintf('The type of a marker shape can only be : %s.', implode(', ', array('circle', 'poly', 'rect'))));
            break;
        }
    }
    
    /**
     * Add a coordinate to the marker shape if the type is poly
     *
     * @param integer $coordinate
     */
    public function addCoordinate($coordinate)
    {
        if($this->type == 'poly')
        {
            if(is_numeric($coordinate))
                $this->coordinates[] = $coordinate;
            else
                throw new \InvalidArgumentException('A coordinate of a poly marker shape must be a numeric value.');
        }
        else
            throw new \InvalidArgumentException('This method can only be use with a marker shape which has type poly.');
    }
}

?>
