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
 * Size builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var double */
    protected $width;

    /** @var double */
    protected $height;

    /** @var string */
    protected $widthUnit;

    /** @var string */
    protected $heightUnit;

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
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the size width.
     *
     * @return double The size width.
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the size width.
     *
     * @param double $width The size width.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The builder.
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Gets the size height.
     *
     * @return double The size height.
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the size height.
     *
     * @param double $height The size height.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The builder.
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Gets the size width unit.
     *
     * @return string The size width unit.
     */
    public function getWidthUnit()
    {
        return $this->widthUnit;
    }

    /**
     * Sets the size width unit.
     *
     * @param string $widthUnit The size width unit.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The builder.
     */
    public function setWidthUnit($widthUnit)
    {
        $this->widthUnit = $widthUnit;

        return $this;
    }

    /**
     * Gets the size height unit.
     *
     * @return string The size height unit.
     */
    public function getHeightUnit()
    {
        return $this->heightUnit;
    }

    /**
     * Sets the size height unit.
     *
     * @param string $heightUnit The size height unit.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The builder.
     */
    public function setHeightUnit($heightUnit)
    {
        $this->heightUnit = $heightUnit;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->height = null;
        $this->width = null;
        $this->heightUnit = null;
        $this->widthUnit = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Base\Size The size.
     */
    public function build()
    {
        $size = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $size->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->width !== null) {
            $size->setWidth($this->width);
        }

        if ($this->height !== null) {
            $size->setHeight($this->height);
        }

        if ($this->widthUnit !== null) {
            $size->setWidthUnit($this->widthUnit);
        }

        if ($this->heightUnit !== null) {
            $size->setHeightUnit($this->heightUnit);
        }

        return $size;
    }
}
