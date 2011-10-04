<?php

namespace Ivory\GoogleMapBundle\Entity;

use Ivory\GoogleMapBundle\Model\Controls\RotateControl as BaseRotateControl;

/**
 * Rotate control entity wich describes a google map rotate control
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RotateControl extends BaseRotateControl
{
    /**
     * Create a rotate control
     */
    public function __construct()
    {
        parent::__construct();
    }
}
