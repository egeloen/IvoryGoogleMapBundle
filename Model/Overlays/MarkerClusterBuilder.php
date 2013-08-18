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
 * Marker cluster builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $type;

    /** @var array */
    protected $markers;

    /** @var array */
    protected $options;

    /**
     * Creates a marker cluster builder.
     *
     * @param string $class The marker cluster class.
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Gets the marker cluster builder prefix javascript variable.
     *
     * @return string The marker cluster builder prefix javascript variable.
     */
    public function getPrefixJavascriptVariable()
    {
        return $this->prefixJavascriptVariable;
    }

    /**
     * Sets the marker cluster builder prefix javascript variable.
     *
     * @param string $prefixJavascriptVariable The marker cluster builder prefix javascript variable.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder The marker cluster builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the marker cluster builder type.
     *
     * @return string The marker cluster builder type.
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the marker cluster builder type.
     *
     * @param string $type The marker cluster builder type.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder The marker cluster builder.
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Gets the marker cluster builder markers.
     *
     * @return array The marker cluster builder markers.
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * Sets the marker cluster builder markers.
     *
     * @param array $markers The marker cluster builder markers.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder The marker cluster builder.
     */
    public function setMarkers(array $markers)
    {
        $this->markers = $markers;

        return $this;
    }

    /**
     * Gets the marker cluster builder options.
     *
     * @return array The marker cluster builder options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the marker cluster builder options.
     *
     * @param array $options The marker cluster builder options.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder The marker cluster builder.
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
        $this->type = null;
        $this->markers = array();
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster The marker cluster.
     */
    public function build()
    {
        $markerCluster = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $markerCluster->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->type !== null) {
            $markerCluster->setType($this->type);
        }

        if (!empty($this->markers)) {
            $markerCluster->setMarkers($this->markers);
        }

        if (!empty($this->options)) {
            $markerCluster->setOptions($this->options);
        }

        return $markerCluster;
    }
}
