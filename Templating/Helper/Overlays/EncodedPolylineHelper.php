<?php

namespace Ivory\GoogleMapBundle\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper;

use Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Encoded Polyline helper
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineHelper
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper $encodingHelper
     */
    protected $encodingHelper = null;

    /**
     * Creates an encoded polyline helper
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper $encodingHelper
     */
    public function __construct(EncodingHelper $encodingHelper)
    {
        $this->encodingHelper = $encodingHelper;
    }

    /**
     * Renders the encoded polyline
     *
     * @param Ivory\GoogleMapBundle\Model\Overlays\EncodedPolyline $encodedPolyline
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function render(EncodedPolyline $encodedPolyline, Map $map)
    {
        $polylineOptions = $encodedPolyline->getOptions();

        $polylineJSONOptions = sprintf('{"map":%s,"path":%s',
            $map->getJavascriptVariable(),
            $this->encodingHelper->renderDecodePath($encodedPolyline->getValue())
        );

        if(!empty($polylineOptions))
            $polylineJSONOptions .= ','.substr(json_encode($polylineOptions), 1);
        else
            $polylineJSONOptions .= '}';

        return sprintf('var %s = new google.maps.Polyline(%s);'.PHP_EOL,
            $encodedPolyline->getJavascriptVariable(),
            $polylineJSONOptions
        );
    }
}
