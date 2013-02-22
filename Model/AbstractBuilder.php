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

use \InvalidArgumentException;

/**
 * Abstract builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractBuilder
{
    /** @var string */
    protected $class;

    /**
     * Creates a builder.
     *
     * @param string $class The class builded by the builder.
     */
    public function __construct($class)
    {
        $this->setClass($class);
    }

    /**
     * Resets the builder.
     *
     * @return \Ivory\GoogleMapBundle\Model\AbstractBuilder The builder.
     */
    abstract public function reset();

    /**
     * Builds an instance.
     *
     * @return mixed The instance.
     */
    abstract public function build();

    /**
     * Gets the class.
     *
     * @return string The class builded.
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Sets the class.
     *
     * @param string $class The class builded.
     *
     * @throws \InvalidArgumentException If the class is not valid.
     *
     * @return \Ivory\GoogleMapBundle\Model\AbstractBuilder The builder.
     */
    public function setClass($class)
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf('The class "%s" does not exist.', $class));
        }

        $this->class = $class;

        return $this;
    }
}
