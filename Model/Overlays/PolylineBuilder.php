<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Polyline builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var array */
    protected $coordinates;

    /** @var array */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\PolylineBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the coordinates.
     *
     * @return array The coordinates.
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Adds a coordinate.
     *
     * @param double  $latitude  The latitude.
     * @param double  $longitude The longitude.
     * @param boolean $noWrap    The no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\PolylineBuilder The builder.
     */
    public function addCoordinate($latitude, $longitude, $noWrap = true)
    {
        $this->coordinates[] = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * Gets the options.
     *
     * @return array The options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options.
     *
     * @param array $options The options.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\PolylineBuilder The builder.
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->coordinates = array();
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\Polyline The polyline.
     */
    public function build()
    {
        $polyline = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $polyline->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        foreach ($this->coordinates as $coordinate) {
            $polyline->addCoordinate($coordinate[0], $coordinate[1], $coordinate[2]);
        }

        if (!empty($this->options)) {
            $polyline->setOptions($this->options);
        }

        return $polyline;
    }
}
