<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Bound builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var array */
    protected $southWest;

    /** @var array */
    protected $northEast;

    /**
     * Creates a bound builder.
     *
     * @param string                                              $class             The bound class.
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder $coordinateBuilder The coordinate builder.
     */
    public function __construct($class, CoordinateBuilder $coordinateBuilder)
    {
        parent::__construct($class);

        $this->setCoordinateBuilder($coordinateBuilder);
        $this->reset();
    }

    /**
     * Gets the coordinate builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder The coordinate builder.
     */
    public function getCoordinateBuilder()
    {
        return $this->coordinateBuilder;
    }

    /**
     * Sets the coordinate builder.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder $coordinateBuilder The coordinate builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\BoundBuilder The builder.
     */
    public function setCoordinateBuilder(CoordinateBuilder $coordinateBuilder)
    {
        $this->coordinateBuilder = $coordinateBuilder;

        return $this;
    }

    /**
     * Gets the prefix javascript variable.
     *
     * @return string The prefix javascript variable.
     */
    public function getPrefixJavascriptVariable()
    {
        return $this->prefixJavascriptVariable;
    }

    /**
     * Sets the prefix javascript variable.
     *
     * @param string $prefixJavascriptVariable The prefix javascript variable.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\BoundBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the bound south west.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The bound south west.
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the bound south west.
     *
     * @param double  $latitude  The latitude.
     * @param double  $longitude The longitude.
     * @param boolean $noWrap    The no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\BoundBuilder The builder.
     */
    public function setSouthWest($latitude, $longitude, $noWrap = true)
    {
        $this->southWest = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * Gets the bound north east.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The bound north east.
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the bound north east.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\BoundBuilder The builder.
     */
    public function setNorthEast($latitude, $longitude, $noWrap = true)
    {
        $this->northEast = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->coordinateBuilder->reset();

        $this->prefixJavascriptVariable = null;
        $this->southWest = array();
        $this->northEast = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Base\Bound The bound.
     */
    public function build()
    {
        $bound = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $bound->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if (!empty($this->southWest)) {
            $southWest = $this->coordinateBuilder
                ->reset()
                ->setLatitude($this->southWest[0])
                ->setLongitude($this->southWest[1])
                ->setNoWrap($this->southWest[2])
                ->build();

            $bound->setSouthWest($southWest);
        }

        if (!empty($this->northEast)) {
            $northEast = $this->coordinateBuilder
                ->reset()
                ->setLatitude($this->northEast[0])
                ->setLongitude($this->northEast[1])
                ->setNoWrap($this->northEast[2])
                ->build();

            $bound->setNorthEast($northEast);
        }

        return $bound;
    }
}
