<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Services\DistanceMatrix;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Distance matrix request builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixRequestBuilder extends AbstractBuilder
{
    /** @var boolean */
    protected $avoidHighways;

    /** @var boolean */
    protected $avoidTolls;

    /** @var array */
    protected $origins;

    /** @var array */
    protected $destinations;

    /** @var string */
    protected $travelMode;

    /** @var string */
    protected $unitSystem;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a distance matrix request builder.
     *
     * @param string $class The class to build.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The builder.
     */
    public function setAvoidTolls($avoidTolls)
    {
        $this->avoidTolls = $avoidTolls;

        return $this;
    }

    /**
     * Gets the origins.
     *
     * @return array The origins.
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * Sets the origins.
     *
     * @param array $origins The origins.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
     */
    public function setOrigins(array $origins)
    {
        $this->origins = $origins;

        return $this;
    }

    /**
     * Gets the destinations.
     *
     * @return array The destinations.
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Sets the destionations.
     *
     * @param array $destinations The destinations.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
     */
    public function setDestinations(array $destinations)
    {
        $this->destinations = $destinations;

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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
     */
    public function setUnitSystem($unitSystem)
    {
        $this->unitSystem = $unitSystem;

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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Gets the sensor flag.
     *
     * @return boolean TRUE if the sensor flag is enabled else FALSE.
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor flag.
     *
     * @param boolean $sensor TRUE if the sensor flag is enabled else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\DistanceMatrix\DistanceMatrixRequestBuilder The distance matrix request builder.
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
        $this->origins = array();
        $this->destinations = array();
        $this->travelMode = null;
        $this->unitSystem = null;
        $this->region = null;
        $this->language = null;
        $this->sensor = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Services\DistanceMatrix\DistanceMatrixRequest The distance matrix request.
     */
    public function build()
    {
        $request = new $this->class();

        if ($this->avoidHighways !== null) {
            $request->setAvoidHighways($this->avoidHighways);
        }

        if ($this->avoidTolls !== null) {
            $request->setAvoidTolls($this->avoidTolls);
        }

        if (!empty($this->origins)) {
            $request->setOrigins($this->origins);
        }

        if (!empty($this->destinations)) {
            $request->setDestinations($this->destinations);
        }

        if ($this->travelMode !== null) {
            $request->setTravelMode($this->travelMode);
        }

        if ($this->unitSystem !== null) {
            $request->setUnitSystem($this->unitSystem);
        }

        if ($this->region !== null) {
            $request->setRegion($this->region);
        }

        if ($this->language !== null) {
            $request->setLanguage($this->language);
        }

        if ($this->sensor !== null) {
            $request->setSensor($this->sensor);
        }

        return $request;
    }
}
