<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Geometry;

/**
 * Encoding Helper
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#encoding
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingHelper
{
    /**
     * Renders the decode path method
     * 
     * @param string $encodedPath
     */
    public function renderDecodePath($encodedPath)
    {
        if(is_string($encodedPath))
            return sprintf('google.maps.geometry.encoding.decodePath("%s")', $encodedPath);
        else
            throw new \InvalidArgumentException('The encoded path must be a string value.');
    }
}
