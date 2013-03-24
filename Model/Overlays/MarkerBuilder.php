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
 * Marker builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var array */
    protected $position;

    /** @var string */
    protected $animation;

    /** @var array */
    protected $options;

    /**
     * Creates a marker builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Layers\MarkerBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Layers\MarkerBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the position.
     *
     * @return array The position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position.
     *
     * @param double  $latitude  The latitude.
     * @param double  $longitude The longitude.
     * @param boolean $noWrap    The no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Layers\MarkerBuilder The builder.
     */
    public function setPosition($latitude, $longtitude, $noWrap = true)
    {
        $this->position = array($latitude, $longtitude, $noWrap);

        return $this;
    }

    /**
     * Gets the animation.
     *
     * @return string The animation.
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Sets the animation.
     *
     * @param string $animation The animation.
     *
     * @return \Ivory\GoogleMapBundle\Model\Layers\MarkerBuilder The builder.
     */
    public function setAnimation($animation)
    {
        $this->animation = $animation;

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
     * @return \Ivory\GoogleMapBundle\Model\Layers\MarkerBuilder The builder.
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
        $this->position = array();
        $this->animation = null;
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\Marker The marker.
     */
    public function build()
    {
        $marker = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $marker->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if (!empty($this->position)) {
            $position = $this->coordinateBuilder
                ->reset()
                ->setLatitude($this->position[0])
                ->setLongitude($this->position[1])
                ->setNoWrap($this->position[2])
                ->build();

            $marker->setPosition($position);
        }

        if ($this->animation !== null) {
            $marker->setAnimation($this->animation);
        }

        if (!empty($this->options)) {
            $marker->setOptions($this->options);
        }

        return $marker;
    }
}
