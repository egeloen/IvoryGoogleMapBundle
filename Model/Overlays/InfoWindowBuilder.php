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
use Ivory\GoogleMapBundle\Model\Base\SizeBuilder;

/**
 * Info window builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeBuilder */
    protected $sizeBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $content;

    /** @var array */
    protected $position;

    /** @var array */
    protected $pixelOffset;

    /** @var boolean */
    protected $open;

    /** @var string */
    protected $openEvent;

    /** @var boolean */
    protected $autoOpen;

    /** @var boolean */
    protected $autoClose;

    /** @var array */
    protected $options;

    /**
     * Creates an info window builder.
     *
     * @param string                                              $class             The class to build.
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder $coordinateBuilder The coordinate builder.
     * @param \Ivory\GoogleMapBundle\Model\Base\SizeBuilder       $sizeBuilder       The size builder.
     */
    public function __construct($class, CoordinateBuilder $coordinateBuilder, SizeBuilder $sizeBuilder)
    {
        parent::__construct($class);

        $this->setCoordinateBuilder($coordinateBuilder);
        $this->setSizeBuilder($sizeBuilder);
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setCoordinateBuilder(CoordinateBuilder $coordinateBuilder)
    {
        $this->coordinateBuilder = $coordinateBuilder;

        return $this;
    }

    /**
     * Gets the size builder.
     *
     * @return type The size builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setSizeBuilder(SizeBuilder $sizeBuilder)
    {
        $this->sizeBuilder = $sizeBuilder;

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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the content.
     *
     * @return string The content.
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content.
     *
     * @param string $content The content.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setContent($content)
    {
        $this->content = $content;

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
     * @param double  $latitude  The position latitude.
     * @param double  $longitude The position longitude.
     * @param boolean $noWrap    The position no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setPosition($latitude, $longitude, $noWrap = true)
    {
        $this->position = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * Gets the pixel offset.
     *
     * @return array The pixel offset.
     */
    public function getPixelOffset()
    {
        return $this->pixelOffset;
    }

    /**
     * Sets the pixel offset.
     *
     * @param double $width      The pixel offset width.
     * @param double $height     The pixel offset height.
     * @param string $widthUnit  The pixel offset width unit.
     * @param string $heightUnit The pixel offset height unit.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setPixelOffset($width, $height, $widthUnit = null, $heightUnit = null)
    {
        $this->pixelOffset = array($width, $height, $widthUnit, $heightUnit);

        return $this;
    }

    /**
     * Checks if it is open.
     *
     * @return boolean TRUE if it is open else FALSE.
     */
    public function isOpen()
    {
        return $this->open;
    }

    /**
     * Sets if it is open.
     *
     * @param boolean $open TRUE if it is open else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Gets the open event.
     *
     * @return string The open event.
     */
    public function getOpenEvent()
    {
        return $this->openEvent;
    }

    /**
     * Sets the open event.
     *
     * @param string $openEvent The open event.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setOpenEvent($openEvent)
    {
        $this->openEvent = $openEvent;

        return $this;
    }

    /**
     * Checks if it auto opens.
     *
     * @return boolean TRUE if it auto opens else FALSE.
     */
    public function isAutoOpen()
    {
        return $this->autoOpen;
    }

    /**
     * Sets if it auto opens.
     *
     * @param boolean $autoOpen TRUE if it auto opens else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setAutoOpen($autoOpen)
    {
        $this->autoOpen = $autoOpen;

        return $this;
    }

    /**
     * Checks if it auto closes.
     *
     * @return boolean TRUE if it auto closes else FALSE.
     */
    public function isAutoClose()
    {
        return $this->autoClose;
    }

    /**
     * Sets if it auto closes.
     *
     * @param boolean $autoClose TRUE if it auto closes else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
     */
    public function setAutoClose($autoClose)
    {
        $this->autoClose = $autoClose;

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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder The builder.
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
        $this->sizeBuilder->reset();

        $this->prefixJavascriptVariable = null;
        $this->content = null;
        $this->position = array();
        $this->pixelOffset = array();
        $this->open = null;
        $this->openEvent = null;
        $this->autoOpen = null;
        $this->autoClose = null;
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow The info window.
     */
    public function build()
    {
        $infoWindow = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $infoWindow->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->content !== null) {
            $infoWindow->setContent($this->content);
        }

        if (!empty($this->position)) {
            $position = $this->coordinateBuilder
                ->reset()
                ->setLatitude($this->position[0])
                ->setLongitude($this->position[1])
                ->setNoWrap($this->position[2])
                ->build();

            $infoWindow->setPosition($position);
        }

        if (!empty($this->pixelOffset)) {
            $pixelOffset = $this->sizeBuilder
                ->reset()
                ->setWidth($this->pixelOffset[0])
                ->setHeight($this->pixelOffset[1])
                ->setWidthUnit($this->pixelOffset[2])
                ->setHeightUnit($this->pixelOffset[3])
                ->build();

            $infoWindow->setPixelOffset($pixelOffset);
        }

        if ($this->open !== null) {
            $infoWindow->setOpen($this->open);
        }

        if ($this->openEvent !== null) {
            $infoWindow->setOpenEvent($this->openEvent);
        }

        if ($this->autoOpen !== null) {
            $infoWindow->setAutoOpen($this->autoOpen);
        }

        if ($this->autoClose !== null) {
            $infoWindow->setAutoClose($this->autoClose);
        }

        if (!empty($this->options)) {
            $infoWindow->setOptions($this->options);
        }

        return $infoWindow;
    }
}
