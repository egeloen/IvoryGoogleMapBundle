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
use Ivory\GoogleMapBundle\Model\Base\PointBuilder;
use Ivory\GoogleMapBundle\Model\Base\SizeBuilder;

/**
 * Marker image builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\PointBuilder */
    protected $pointBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeBuilder */
    protected $sizeBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $url;

    /** @var array */
    protected $anchor;

    /** @var array */
    protected $origin;

    /** @var array */
    protected $scaledSize;

    /** @var array */
    protected $size;

    /**
     * Creates a marker image builder.
     *
     * @param string                                         $class        The class to build.
     * @param \Ivory\GoogleMapBundle\Model\Base\PointBuilder $pointBuilder The point builder.
     * @param \Ivory\GoogleMapBundle\Model\Base\SizeBuilder  $sizeBuilder  The size builder.
     */
    public function __construct($class, PointBuilder $pointBuilder, SizeBuilder $sizeBuilder)
    {
        parent::__construct($class);

        $this->setPointBuilder($pointBuilder);
        $this->setSizeBuilder($sizeBuilder);
        $this->reset();
    }

    /**
     * Gets the point builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\PointBuilder The point builder.
     */
    public function getPointBuilder()
    {
        return $this->pointBuilder;
    }

    /**
     * Sets the point builder.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\PointBuilder $pointBuilder The point builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setPointBuilder(PointBuilder $pointBuilder)
    {
        $this->pointBuilder = $pointBuilder;

        return $this;
    }

    /**
     * Gets the size builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\SizeBuilder The size builder.
     */
    public function getSizeBuilder()
    {
        return $this->sizeBuilder;
    }

    /**
     * Sets the size builder.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\SizeBuilder $sizeBuilder The size builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setSizeBuilder(SizeBuilder $sizeBuilder)
    {
        $this->sizeBuilder = $sizeBuilder;

        return $this;
    }

    /**
     * Gets the javascript variable.
     *
     * @return string The javascript variable.
     */
    public function getPrefixJavascriptVariable()
    {
        return $this->prefixJavascriptVariable;
    }

    /**
     * Sets the javascript variable.
     *
     * @param string $prefixJavascriptVariable The javascript variable.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the url.
     *
     * @return string The url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url.
     *
     * @param string $url The url.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the anchor.
     *
     * @return array The anchor.
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Sets the anchor.
     *
     * @param double $x The X coordinate.
     * @param double $y The Y coordinate.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setAnchor($x, $y)
    {
        $this->anchor = array($x, $y);

        return $this;
    }

    /**
     * Gets the origin.
     *
     * @return double The origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin.
     *
     * @param double $x The X coordinate.
     * @param double $y The Y coordinate.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setOrigin($x, $y)
    {
        $this->origin = array($x, $y);

        return $this;
    }

    /**
     * Gets the scaled size.
     *
     * @return array The scaled size.
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * Sets the scaled size.
     *
     * @param double $width      The width.
     * @param double $height     The height.
     * @param string $widthUnit  The width unit.
     * @param string $heightUnit The height unit.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setScaledSize($width, $height, $widthUnit = null, $heightUnit = null)
    {
        $this->scaledSize = array($width, $height, $widthUnit, $heightUnit);

        return $this;
    }

    /**
     * Gets the size.
     *
     * @return array The size.
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size.
     *
     * @param double $width      The width.
     * @param double $height     The height.
     * @param string $widthUnit  The width unit.
     * @param string $heightUnit The height unit.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerImageBuilder The builder.
     */
    public function setSize($width, $height, $widthUnit = null, $heightUnit = null)
    {
        $this->size = array($width, $height, $widthUnit, $heightUnit);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->url = null;
        $this->anchor = array();
        $this->origin = array();
        $this->scaledSize = array();
        $this->size = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerImage The marker image.
     */
    public function build()
    {
        $markerImage = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $markerImage->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->url !== null) {
            $markerImage->setUrl($this->url);
        }

        if (!empty($this->anchor)) {
            $anchor = $this->pointBuilder
                ->reset()
                ->setX($this->anchor[0])
                ->setY($this->anchor[1])
                ->build();

            $markerImage->setAnchor($anchor);
        }

        if (!empty($this->origin)) {
            $origin = $this->pointBuilder
                ->reset()
                ->setX($this->origin[0])
                ->setY($this->origin[1])
                ->build();

            $markerImage->setOrigin($origin);
        }

        if (!empty($this->scaledSize)) {
            $scaledSize = $this->sizeBuilder
                ->reset()
                ->setWidth($this->scaledSize[0])
                ->setHeight($this->scaledSize[1])
                ->setWidthUnit($this->scaledSize[2])
                ->setHeightUnit($this->scaledSize[3])
                ->build();

            $markerImage->setScaledSize($scaledSize);
        }

        if (!empty($this->size)) {
            $size = $this->sizeBuilder
                ->reset()
                ->setWidth($this->size[0])
                ->setHeight($this->size[1])
                ->setWidthUnit($this->size[2])
                ->setHeightUnit($this->size[3])
                ->build();

            $markerImage->setSize($size);
        }

        return $markerImage;
    }
}
