<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model;

use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;

/**
 * Map builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $htmlContainerId;

    /** @var boolean */
    protected $async;

    /** @var boolean */
    protected $autoZoom;

    /** @var array */
    protected $libraries;

    /** @var string */
    protected $language;

    /** @var array */
    protected $center;

    /** @var array */
    protected $bound;

    /** @var array */
    protected $mapOptions;

    /** @var array */
    protected $stylesheetOptions;

    /**
     * Creates a map builder.
     *
     * @param string                                              $class             The class to build.
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder $coordinateBuilder The coordinate builder.
     * @param \Ivory\GoogleMapBundle\Model\Base\BoundBuilder      $boundBuilder      The bound builder.
     */
    public function __construct($class, CoordinateBuilder $coordinateBuilder, BoundBuilder $boundBuilder)
    {
        parent::__construct($class);

        $this->setCoordinateBuilder($coordinateBuilder);
        $this->setBoundBuilder($boundBuilder);
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
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setCoordinateBuilder(CoordinateBuilder $coordinateBuilder)
    {
        $this->coordinateBuilder = $coordinateBuilder;

        return $this;
    }

    /**
     * Gets the bound builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\BoundBuilder The bound builder.
     */
    public function getBoundBuilder()
    {
        return $this->boundBuilder;
    }

    /**
     * Sets the bound builder.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\BoundBuilder $boundBuilder The bound builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setBoundBuilder(BoundBuilder $boundBuilder)
    {
        $this->boundBuilder = $boundBuilder;

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
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the html container ID.
     *
     * @return string The html container ID.
     */
    public function getHtmlContainerId()
    {
        return $this->htmlContainerId;
    }

    /**
     * Sets the html container ID.
     *
     * @param string $htmlContainerId The html container ID.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setHtmlContainerId($htmlContainerId)
    {
        $this->htmlContainerId = $htmlContainerId;

        return $this;
    }

    /**
     * Checks if the map is async.
     *
     * @return boolean TRUE if the map is async else FALSE.
     */
    public function getAsync()
    {
        return $this->async;
    }

    /**
     * Sets if the map is async.
     *
     * @param boolean $async TRUE if the map is async else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setAsync($async)
    {
        $this->async = $async;

        return $this;
    }

    /**
     * Checks if the map auto zoom.
     *
     * @return boolean TRUE if the map auto zoom else FALSE.
     */
    public function getAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * Sets if the map auto zoom.
     *
     * @param boolean $autoZoom TRUE if the map auto zoom else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setAutoZoom($autoZoom)
    {
        $this->autoZoom = $autoZoom;

        return $this;
    }

    /**
     * Gets the libraries.
     *
     * @return array The libraries.
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * Sets the libraries.
     *
     * @param array $libraries The libraries.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setLibraries(array $libraries)
    {
        $this->libraries = $libraries;

        return $this;
    }

    /**
     * Gets the language.
     *
     * @return string The language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string $language The language.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setLanguage($language)
    {
        $this->language = $language;

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
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setCenter($latitude, $longitude, $noWrap = true)
    {
        $this->center = array($latitude, $longitude, $noWrap);

        return $this;
    }

    /**
     * Gets the bound.
     *
     * @return array The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param double  $southWestLatitude  The south west latitude.
     * @param double  $southWestLongitude The south west longitude.
     * @param double  $northEastLatitude  The north east latitude.
     * @param double  $northEastLongitude The north east longitude.
     * @param boolean $southWestNoWrap    The south west no wrap.
     * @param boolean $northEastNoWrap    The north east no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setBound(
        $southWestLatitude,
        $southWestLongitude,
        $northEastLatitude,
        $northEastLongitude,
        $southWestNoWrap = true,
        $northEastNoWrap = true
    ) {
        $this->bound = array(
            $southWestLatitude,
            $southWestLongitude,
            $southWestNoWrap,
            $northEastLatitude,
            $northEastLongitude,
            $northEastNoWrap,
        );

        return $this;
    }

    /**
     * Gets the map options.
     *
     * @return array The map options.
     */
    public function getMapOptions()
    {
        return $this->mapOptions;
    }

    /**
     * Sets the map options.
     *
     * @param array $mapOptions The map options.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setMapOptions(array $mapOptions)
    {
        $this->mapOptions = $mapOptions;

        return $this;
    }

    /**
     * Gets the stylesheet options.
     *
     * @return array The stylesheet options.
     */
    public function getStylesheetOptions()
    {
        return $this->stylesheetOptions;
    }

    /**
     * Sets the stylesheet options.
     *
     * @param array $stylesheetOptions The stylesheet options.
     *
     * @return \Ivory\GoogleMapBundle\Model\MapBuilder The builder.
     */
    public function setStylesheetOptions(array $stylesheetOptions)
    {
        $this->stylesheetOptions = $stylesheetOptions;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->htmlContainerId = null;
        $this->async = null;
        $this->autoZoom = null;
        $this->libraries = array();
        $this->language = null;
        $this->center = array();
        $this->bound = array();
        $this->mapOptions = array();
        $this->stylesheetOptions = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Map The map.
     */
    public function build()
    {
        $map = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $map->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->htmlContainerId !== null) {
            $map->setHtmlContainerId($this->htmlContainerId);
        }

        if ($this->async !== null) {
            $map->setAsync($this->async);
        }

        if ($this->autoZoom !== null) {
            $map->setAutoZoom($this->autoZoom);
        }

        if (!empty($this->libraries)) {
            $map->setLibraries($this->libraries);
        }

        if ($this->language !== null) {
            $map->setLanguage($this->language);
        }

        if (!empty($this->center)) {
            $map->setCenter($this->center[0], $this->center[1], $this->center[2]);
        }

        if (!empty($this->bound)) {
            $map->setBound(
                $this->bound[0],
                $this->bound[1],
                $this->bound[3],
                $this->bound[4],
                $this->bound[2],
                $this->bound[5]
            );
        }

        if (!empty($this->mapOptions)) {
            $map->setMapOptions($this->mapOptions);
        }

        if (!empty($this->stylesheetOptions)) {
            $map->setStylesheetOptions($this->stylesheetOptions);
        }

        return $map;
    }
}
