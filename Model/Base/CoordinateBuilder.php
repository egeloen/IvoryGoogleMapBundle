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
 * Coordinate builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var double */
    protected $latitude;

    /** @var double */
    protected $longitude;

    /** @var boolean */
    protected $noWrap;

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
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the coordinate latitude.
     *
     * @return double he coordinate latitude.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the coordinate latitude.
     *
     * @param double $latitude The coordinate latitude.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder The builder.
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Gets the coordinate longitude.
     *
     * @return double The coordinate longitude.
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the coordinate longitude.
     *
     * @param double $longitude The coordinate longitude.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder The builder.
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Checks if the coordinate has no wrap.
     *
     * @return boolean TRUE if the coordinate has no wrap else FALSE.
     */
    public function isNoWrap()
    {
        return $this->noWrap;
    }

    /**
     * Sets the coordinate no wrap.
     *
     * @param boolean $noWrap TRUE if the coordinate has no wrap else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder The builder.
     */
    public function setNoWrap($noWrap)
    {
        $this->noWrap = $noWrap;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->noWrap = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The coordinate.
     */
    public function build()
    {
        $coordinate = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $coordinate->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->latitude !== null) {
            $coordinate->setLatitude($this->latitude);
        }

        if ($this->longitude !== null) {
            $coordinate->setLongitude($this->longitude);
        }

        if ($this->noWrap !== null) {
            $coordinate->setNoWrap($this->noWrap);
        }

        return $coordinate;
    }
}
