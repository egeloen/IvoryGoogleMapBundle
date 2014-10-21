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
use Ivory\GoogleMapBundle\Model\Base\BoundBuilder;

/**
 * Ground overlay builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlayBuilder extends AbstractBuilder
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $url;

    /** @var array */
    protected $bound;

    /** @var array */
    protected $options;

    /**
     * Creates a ground overlay builder.
     *
     * @param string                                         $class        The class to build.
     * @param \Ivory\GoogleMapBundle\Model\Base\BoundBuilder $boundBuilder The bound builder.
     */
    public function __construct($class, BoundBuilder $boundBuilder)
    {
        parent::__construct($class);

        $this->setBoundBuilder($boundBuilder);
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder The builder.
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * @param double  $northEastLatitude  The south west no wrap.
     * @param double  $northEastLongitude The north east latitude.
     * @param boolean $southWestNoWrap    The north east longitude.
     * @param boolean $northEastNoWrap    The north east no wrap.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder The builder.
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\GroundOverlayBuilder The builder.
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
        $this->boundBuilder->reset();

        $this->prefixJavascriptVariable = null;
        $this->url = null;
        $this->bound = array();
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\GroundOverlay The ground overlay.
     */
    public function build()
    {
        $groundOverlay = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $groundOverlay->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->url !== null) {
            $groundOverlay->setUrl($this->url);
        }

        if (!empty($this->bound)) {
            $groundOverlay->setBound(
                $this->bound[0],
                $this->bound[1],
                $this->bound[3],
                $this->bound[4],
                $this->bound[2],
                $this->bound[5]
            );
        }

        if (!empty($this->options)) {
            $groundOverlay->setOptions($this->options);
        }

        return $groundOverlay;
    }
}
