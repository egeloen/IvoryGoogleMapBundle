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
 * Point builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var double */
    protected $x;

    /** @var double */
    protected $y;

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
     * @return \Ivory\GoogleMapBundle\Model\Base\PointBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the X coordinate.
     *
     * @return double The X coordinate.
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets the X coordinate.
     *
     * @param double $x The X coordinate.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\PointBuilder The builder.
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Gets the Y coordinate.
     *
     * @return double The Y coordinate.
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Sets the Y coordinate.
     *
     * @param double $y The Y coordinate.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\PointBuilder The builder.
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->x = null;
        $this->y = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Base\Point The point.
     */
    public function build()
    {
        $point = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $point->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->x !== null) {
            $point->setX($this->x);
        }

        if ($this->y !== null) {
            $point->setY($this->y);
        }

        return $point;
    }
}
