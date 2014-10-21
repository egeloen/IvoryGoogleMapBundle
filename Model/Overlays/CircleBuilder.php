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
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;

/**
 * Circle builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var array */
    protected $center;

    /** @var double */
    protected $radius;

    /** @var array */
    protected $options;

    /**
     * Creates a circle builder.
     *
     * @param string                                              $class             The class to build.
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
     * @return type The coordinate builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\CircleBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\CircleBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the center.
     *
     * @return array The center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the center.
     *
     * @param double  $latitude  The center latitude.
     * @param double  $longitude The center longitude.
     * @param boolean $noWrap    The center no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\CircleBuilder The builder.
     */
    public function setCenter($latitude, $longitude, $noWrap = true)
    {
        $this->center = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * Gets the radius.
     *
     * @return double The radius.
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Sets the radius.
     *
     * @param double $radius The radius.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\CircleBuilder The builder.
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\CircleBuilder The builder.
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
        $this->coordinateBuilder->reset();

        $this->prefixJavascriptVariable = null;
        $this->center = array();
        $this->radius = null;
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\Circle The circle.
     */
    public function build()
    {
        $circle = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $circle->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if (!empty($this->center)) {
            $center = $this->coordinateBuilder
                ->reset()
                ->setLatitude($this->center[0])
                ->setLongitude($this->center[1])
                ->setNoWrap($this->center[2])
                ->build();

            $circle->setCenter($center);
        }

        if ($this->radius !== null) {
            $circle->setRadius($this->radius);
        }

        if (!empty($this->options)) {
            $circle->setOptions($this->options);
        }

        return $circle;
    }
}
