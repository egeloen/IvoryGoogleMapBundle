<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Services\Directions;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * The directions request builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequestBuilder extends AbstractBuilder
{
    /** @var boolean */
    protected $avoidHighways;

    /** @var boolean */
    protected $avoidTolls;

    /** @var string */
    protected $destination;

    /** @var boolean */
    protected $optimizeWaypoints;

    /** @var string */
    protected $origin;

    /** @var boolean */
    protected $provideRouteAlternatives;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var string */
    protected $travelMode;

    /** @var string */
    protected $unitSystem;

    /** @var array */
    protected $waypoints;

    /** @var boolean */
    protected $sensor;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Checks if it avoids highways.
     *
     * @return boolean TRUE if it avoids highways else FALSE.
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * Sets if it avoids highways.
     *
     * @param boolean $avoidHighways TRUE if it avoids highways else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setAvoidHighways($avoidHighways)
    {
        $this->avoidHighways = $avoidHighways;

        return $this;
    }

    /**
     * Checks if it avoids tolls.
     *
     * @return boolean TRUE if it avoids tolls else FALSE.
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * Sets if it avoids tolls.
     *
     * @param boolean $avoidTolls TRUE if it avoids tolls else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setAvoidTolls($avoidTolls)
    {
        $this->avoidTolls = $avoidTolls;

        return $this;
    }

    /**
     * Gets the destination.
     *
     * @return string The destination.
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Sets the destination.
     *
     * @param string $destination The destination.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Checks if it optimizes waypoints.
     *
     * @return boolean TRUE if it optimizes waypoints else FALSE.
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }

    /**
     * Sets if it optimizes waypoints.
     *
     * @param boolean $optimizeWaypoints TRUE if it optimizes waypoints else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setOptimizeWaypoints($optimizeWaypoints)
    {
        $this->optimizeWaypoints = $optimizeWaypoints;

        return $this;
    }

    /**
     * Gets the origin.
     *
     * @return string The origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin.
     *
     * @param string $origin The origin.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Checks if it provides route alternatives.
     *
     * @return boolean TRUE if it provides route alternatives else FALSE.
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * Sets if it provides route alternatives.
     *
     * @param boolean $provideRouteAlternatives TRUE if it provides route alternatives else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives)
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;

        return $this;
    }

    /**
     * Gets the region.
     *
     * @return string The region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the region.
     *
     * @param string $region The region.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setRegion($region)
    {
        $this->region = $region;

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
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Gets the travel mode.
     *
     * @return string The travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the travel mode.
     *
     * @param string $travelMode The travel mode.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setTravelMode($travelMode)
    {
        $this->travelMode = $travelMode;

        return $this;
    }

    /**
     * Gets the unit system.
     *
     * @return string The unit system.
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * Sets the unit system.
     *
     * @param string $unitSystem The unit system.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setUnitSystem($unitSystem)
    {
        $this->unitSystem = $unitSystem;

        return $this;
    }

    /**
     * Gets the waypoints.
     *
     * @return array The waypoints.
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * Sets the waypoints.
     *
     * @param array $waypoints The waypoints.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setWaypoints(array $waypoints)
    {
        $this->waypoints = $waypoints;

        return $this;
    }

    /**
     * Gets the sensor.
     *
     * @return boolean The sensor.
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor.
     *
     * @param boolean $sensor The sensor.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Directions\DirectionsRequestBuilder The builder.
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->avoidHighways = null;
        $this->avoidTolls = null;
        $this->destination = null;
        $this->optimizeWaypoints = null;
        $this->origin = null;
        $this->provideRouteAlternatives = null;
        $this->region = null;
        $this->language = null;
        $this->travelMode = null;
        $this->unitSystem = null;
        $this->waypoints = array();
        $this->sensor = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Services\Directions\DirectionsRequest The directions request.
     */
    public function build()
    {
        $directionsRequest = new $this->class();

        if ($this->avoidHighways !== null) {
            $directionsRequest->setAvoidHighways($this->avoidHighways);
        }

        if ($this->avoidTolls !== null) {
            $directionsRequest->setAvoidTolls($this->avoidTolls);
        }

        if ($this->destination !== null) {
            $directionsRequest->setDestination($this->destination);
        }

        if ($this->optimizeWaypoints !== null) {
            $directionsRequest->setOptimizeWaypoints($this->optimizeWaypoints);
        }

        if ($this->origin !== null) {
            $directionsRequest->setOrigin($this->origin);
        }

        if ($this->provideRouteAlternatives !== null) {
            $directionsRequest->setProvideRouteAlternatives($this->provideRouteAlternatives);
        }

        if ($this->region !== null) {
            $directionsRequest->setRegion($this->region);
        }

        if ($this->language !== null) {
            $directionsRequest->setLanguage($this->language);
        }

        if ($this->travelMode !== null) {
            $directionsRequest->setTravelMode($this->travelMode);
        }

        if ($this->unitSystem !== null) {
            $directionsRequest->setUnitSystem($this->unitSystem);
        }

        if (!empty($this->waypoints)) {
            $directionsRequest->setWaypoints($this->waypoints);
        }

        if ($this->sensor !== null) {
            $directionsRequest->setSensor($this->sensor);
        }

        return $directionsRequest;
    }
}
