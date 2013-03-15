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
 * Encoded polyline builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $value;

    /** @var array */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
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
     * @return \Ivory\GoogleMapBundle\Model\Overlays\EncodedPolylineBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the value.
     *
     * @return string The value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value.
     *
     * @param string $value The value.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\EncodedPolylineBuilder The builder.
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Gets the options.
     *
     * @return string The options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options.
     * The builder.
     * @param array $options The options.
     *
     * @return \Ivory\GoogleMapBundle\Model\Overlays\EncodedPolylineBuilder The builder.
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
        $this->value = null;
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Overlays\EncodedPolyline The encoded polyline.
     */
    public function build()
    {
        $encodedPolyline = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $encodedPolyline->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->value !== null) {
            $encodedPolyline->setValue($this->value);
        }

        if (!empty($this->options)) {
            $encodedPolyline->setOptions($this->options);
        }

        return $encodedPolyline;
    }
}
