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
 * Marker shape builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $type;

    /** @var array */
    protected $coordinates;

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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerShapeBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the type.
     *
     * @return string The type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type.
     *
     * @param string $type The type.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerShapeBuilder The builder.
     */
    public function setType($type)
    {
        $this->type = $type;

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
     * Sets the coordinates.
     *
     * @param array $coordinates The coordinates.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerShapeBuilder The builder.
     */
    public function setCoordinates(array $coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->type = null;
        $this->coordinates = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerShape The marker shape.
     */
    public function build()
    {
        $markerShape = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $markerShape->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->type !== null) {
            $markerShape->setType($this->type);
        }

        if (!empty($this->coordinates)) {
            $markerShape->setCoordinates($this->coordinates);
        }

        return $markerShape;
    }
}
