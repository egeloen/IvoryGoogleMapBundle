<?php

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMapBundle\Model\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMapBundle\Model\Overlays\IExtendable;

/**
 * Bound wich describes a google map bound
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractJavascriptVariableAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate South west bound
     */
    protected $southWest = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate North east bound
     */
    protected $northEast = null;

    /**
     * @var array Google map objects that bound extends
     */
    protected $extends = array();

    /**
     * Create a bound
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('bound_');
    }

    /**
     * Checks if the bound has coordinates
     *
     * @return boolean TRUE if the bound has coordinates else FALSE
     */
    public function hasCoordinates()
    {
        return !is_null($this->southWest) && !is_null($this->northEast);
    }

    /**
     * Gets the south west bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west bound
     *
     * Available prototype:
     *
     * public function setSouthWest(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest = null)
     * public function setSouthWest(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setSouthWest()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->southWest === null)
                $this->southWest = new Coordinate();

            $this->southWest->setLatitude($args[0]);
            $this->southWest->setLongitude($args[1]);

            if(isset($args[2]) && is_bool($args[2]))
                $this->southWest->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->southWest = $args[0];
        else if(!isset($args[0]))
            $this->southWest = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The south west setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setSouthWest(Ivory\GoogleMapBundle\Model\Base\Coordinate $southWest)',
                ' - public function setSouthWest(double $latitude, double $longitude, boolean $noWrap = true)'));
    }

    /**
     * Gets the north east bound
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east bound
     *
     * Available prototype:
     *
     * public function setNorthEast(Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast = null)
     * public function setNorthEast(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setNorthEast()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->northEast === null)
                $this->northEast = new Coordinate();

            $this->northEast->setLatitude($args[0]);
            $this->northEast->setLongitude($args[1]);

            if(isset($args[2]) && is_bool($args[2]))
                $this->northEast->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->northEast = $args[0];
        else if(!isset($args[0]))
            $this->northEast = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The north east setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setNorthEast(Ivory\GoogleMapBundle\Model\Base\Coordinate $northEast)',
                ' - public function setNorthEast(double $latitude, double $longitude, boolean $noWrap = true)'));
    }

    /**
     * Checks if the bound extends something
     *
     * @return boolean TRUE if the bound extends somethind else FALSE
     */
    public function hasExtends()
    {
        return !empty($this->extends);
    }

    /**
     * Gets the google map objects that bound extends
     *
     * @return array
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets the google map objects that bound extends
     *
     * @param array $extends
     */
    public function setExtends($extends)
    {
        $this->extends = array();

        foreach($extends as $extend)
            $this->extend($extend);
    }

    /**
     * Add an overlay google map extendable object for bound extend it
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\IExtendable $extend
     */
    public function extend(IExtendable $extend)
    {
        $this->extends[] = $extend;
    }

    /**
     * Gets the center of the bound.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getCenter()
    {
        $centerLatitude = ($this->getSouthWest()->getLatitude() + $this->getNorthEast()->getLatitude()) / 2;
        $centerLongitude = ($this->getSouthWest()->getLongitude() + $this->getNorthEast()->getLongitude()) / 2;

        return new Coordinate($centerLatitude, $centerLongitude);
    }
}
