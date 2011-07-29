<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Bound as BaseBound;

/**
 * Bound entity wich describes a google map bound
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends BaseBound
{
    /**
     * Create a bound
     */
    public function __construct()
    {
        parent::__construct();
    }
}
