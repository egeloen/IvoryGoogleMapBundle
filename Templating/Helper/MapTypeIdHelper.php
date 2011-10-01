<?php

namespace Ivory\GoogleMapBundle\Templating\Helper;

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
            case 'hybrid':
                return 'google.maps.MapTypeId.HYBRID';
            break;
        
            case 'roadmap':
                return 'google.maps.MapTypeId.ROADMAP';
            break;
        
            case 'satellite':
                return 'google.maps.MapTypeId.SATELLITE';
            break;
        
            case 'terrain':
                return 'google.maps.MapTypeId.TERRAIN';
            break;

            default:
                throw new \InvalidArgumentException('The map type id is not valid.');
            break;
        }
    }
}
