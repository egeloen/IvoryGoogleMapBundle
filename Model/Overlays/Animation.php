<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

/**
 * Animation which describes a google map animation
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Animation
 * @author GeLo <geloen.eric@gmail.com>
 */
class Animation
{
    const BOUNCE = 'bounce';
    const DROP = 'drop';

    /**
     * Disabled constructor
     */
    final public function __construct()
    {
        throw new \Exception(sprintf('The class "%s" can not be instanciate.', get_class($this)));
    }

    /**
     * Gets the available animations
     *
     * @return array
     */
    public static function getAnimations()
    {
        return array(
            self::BOUNCE,
            self::DROP
        );
    }
}
