<?php

namespace Ivory\GoogleMapBundle\Model\Layers;

use Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset;

/**
 * KML Layer which describes a google map KML layer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayer extends AbstractOptionsAsset
{
    /**
     * @var string The KML Layer URL
     */
    protected $url;

    /**
     * Creates a KML Layer
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('kml_layer_');
    }

    /**
     * Gets the KML Layer URL
     *
     * @return string The KML Layer URL
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the KML Layer URL
     *
     * @param type $url
     * @throws \InvalidArgumentException
     */
    public function setUrl($url)
    {
        if (is_string($url))
            $this->url = $url;
        else
            throw new \InvalidArgumentException('The kml layer url must be a string value.');
    }
}
