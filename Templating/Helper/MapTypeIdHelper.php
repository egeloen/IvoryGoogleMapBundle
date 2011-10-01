<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMapBundle\Model\MapTypeId;

/**
 * Map type ID helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeIdHelper 
{
    /**
     * Renders javascript map map type ID
     *
     * @param string $mapTypeId Map type ID
     * @return string HTML output
     */
    public function render($mapTypeId)
    {
        switch($mapTypeId) 
        {
            case MapTypeId::HYBRID:
                return 'google.maps.MapTypeId.HYBRID';
            break;
        
            case MapTypeId::ROADMAP:
                return 'google.maps.MapTypeId.ROADMAP';
            break;
        
            case MapTypeId::SATELLITE:
                return 'google.maps.MapTypeId.SATELLITE';
            break;
        
            case MapTypeId::TERRAIN:
                return 'google.maps.MapTypeId.TERRAIN';
            break;

            default:
                throw new \InvalidArgumentException('The map type id is not valid.');
            break;
        }
    }
}
