<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Model\Base;

use Ivory\GoogleMap\Base\Bound;

/**
 * Bound factory.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundFactory
{
    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateFactory */
    protected $coordinateFactory;

    /**
     * Creates a bound factory.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateFactory $coordinateFactory The coordinate factory.
     */
    public function __construct(CoordinateFactory $coordinateFactory = null)
    {
        if ($coordinateFactory === null) {
            $coordinateFactory = new CoordinateFactory();
        }

        $this->setCoordinateFactory($coordinateFactory);
    }

    /**
     * Gets the coordinate factory.
     *
     * @return \Ivory\GoogleMapBundle\Model\Base\CoordinateFactory The coordinate factory.
     */
    public function getCoordinateFactory()
    {
        return $this->coordinateFactory;
    }

    /**
     * Sets the coordinate factory.
     *
     * @param \Ivory\GoogleMapBundle\Model\Base\CoordinateFactory $coordinateFactory
     */
    public function setCoordinateFactory(CoordinateFactory $coordinateFactory)
    {
        $this->coordinateFactory = $coordinateFactory;
    }

    /**
     * Creates a bound.
     *
     * @param string  $prefixJavascriptVariable The prefix javascript variable.
     * @param double  $southWestLatitude        The south west latitude.
     * @param double  $southWestLongitude       The south west longitude.
     * @param double  $northEastLatitude        The north east latitude.
     * @param double  $northEastLongitude       The north east longitude.
     * @param boolean $southWestNoWrap          The south west no wrap.
     * @param boolean $northEastNoWrap          The north east no wrap.
     *
     * @return \Ivory\GoogleMap\Base\Bound The bound.
     */
    public function create(
        $prefixJavascriptVariable,
        $southWestLatitude,
        $southWestLongitude,
        $northEastLatitude,
        $northEastLongitude,
        $southWestNoWrap = true,
        $northEastNoWrap = true
    )
    {
        $bound = new Bound(
            $this->coordinateFactory->create($southWestLatitude, $southWestLongitude, $southWestNoWrap),
            $this->coordinateFactory->create($northEastLatitude, $northEastLongitude, $northEastNoWrap)
        );

        $bound->setPrefixJavascriptVariable($prefixJavascriptVariable);

        return $bound;
    }
}
