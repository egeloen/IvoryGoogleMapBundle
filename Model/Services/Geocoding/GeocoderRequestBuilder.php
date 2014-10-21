<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Services\Geocoding;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Geocoder request builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestBuilder extends AbstractBuilder
{
    /** @var string */
    protected $address;

    /** @var array */
    protected $coordinate;

    /** @var array */
    protected $bound;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a geocoder request builder.
     *
     * @param string $class The class to build.
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Gets the address.
     *
     * @return string The address.
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address.
     *
     * @param string $address The address.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request bulder.
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Gets the coordinate.
     *
     * @return array The coordinate.
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Sets the coordinate.
     *
     * @param double  $latitude  The latitude.
     * @param double  $longitude The longitude.
     * @param boolean $noWrap    The nor wrap flag.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request builder.
     */
    public function setCoordinate($latitude, $longitude, $noWrap = true)
    {
        $this->coordinate = array($latitude, $longitude, $noWrap);

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
     * @param boolean $southWestNoWrap    The south west no wrap flag.
     * @param boolean $northEastNoWrap    The north east no wrap flag.
     *
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Services\Geocoding\GeocoderRequestBuilder The geocoder request builder.
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
        $this->address = null;
        $this->coordinate = array();
        $this->bound = array();
        $this->region = null;
        $this->language = null;
        $this->sensor = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Services\Geocoding\GeocoderRequest The geocoder request.
     */
    public function build()
    {
        $geocoderRequest = new $this->class();

        if ($this->address !== null) {
            $geocoderRequest->setAddress($this->address);
        }

        if (!empty($this->coordinate)) {
            $geocoderRequest->setCoordinate($this->coordinate[0], $this->coordinate[1], $this->coordinate[2]);
        }

        if (!empty($this->bound)) {
            $geocoderRequest->setBound(
                $this->bound[0],
                $this->bound[1],
                $this->bound[3],
                $this->bound[4],
                $this->bound[2],
                $this->bound[5]
            );
        }

        if ($this->region !== null) {
            $geocoderRequest->setRegion($this->region);
        }

        if ($this->language !== null) {
            $geocoderRequest->setLanguage($this->language);
        }

        if ($this->sensor !== null) {
            $geocoderRequest->setSensor($this->sensor);
        }

        return $geocoderRequest;
    }
}
