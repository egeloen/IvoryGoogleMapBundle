<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset;

/**
 * Encoded polyline
 *
 * @see http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolyline extends AbstractOptionsAsset implements IExtendable
{
    /**
     * @var string Encoded polyline value
     */
    protected $value = null;
    
    /**
     * Create an encoded polyline
     *
     * @param string $value 
     */
    public function __construct($value)
    {
        $this->setPrefixJavascriptVariable('encoded_polyline_');
        $this->setValue($value);
    }
    
    /**
     * Gets the encoded polyline value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the encoded polyline value
     *
     * @param string $value 
     */
    public function setValue($value)
    {
        if(is_string($value))
            $this->value = $value;
        else
            throw new \invalidArgumentException('The encoded polyline value must be a string value.');
    }
}
