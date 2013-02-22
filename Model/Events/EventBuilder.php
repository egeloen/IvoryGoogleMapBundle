<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Events;

use Ivory\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Event builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $instance;

    /** @var string */
    protected $eventName;

    /** @var string */
    protected $handle;

    /** @var boolean */
    protected $capture;

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
     * @return \Ivory\GoogleMapBundle\Model\Events\EventBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the instance.
     *
     * @return string The instance.
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Sets the instance.
     *
     * @param string $instance The instance.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventBuilder The builder.
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Gets the event name.
     *
     * @return string The event name.
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Sets the event name.
     *
     * @param string $eventName The event name.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventBuilder The builder.
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Gets the handle.
     *
     * @return string The handle.
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Sets the handle.
     *
     * @param string $handle The handle.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventBuilder The builder.
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Checks if the event capture.
     *
     * @return boolean TRUE if the event capture else FALSE.
     */
    public function isCapture()
    {
        return $this->capture;
    }

    /**
     * Sets if the event capture.
     *
     * @param boolean $capture TRUE if the event capture else FALSE.
     *
     * @return \Ivory\GoogleMapBundle\Model\Events\EventBuilder The builder.
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->prefixJavascriptVariable = null;
        $this->instance = null;
        $this->eventName = null;
        $this->handle = null;
        $this->capture = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Ivory\GoogleMap\Events\Event The event.
     */
    public function build()
    {
        $event = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $event->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->instance !== null) {
            $event->setInstance($this->instance);
        }

        if ($this->eventName !== null) {
            $event->setEventName($this->eventName);
        }

        if ($this->handle !== null) {
            $event->setHandle($this->handle);
        }

        if ($this->capture !== null) {
            $event->setCapture($this->capture);
        }

        return $event;
    }
}
