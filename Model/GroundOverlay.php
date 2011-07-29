<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Ground overlay which describes a google map ground overlay
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlay
 * @author GeLo <geloen.eric@gmail.com>
 */
class GroundOverlay extends AbstractAsset
{
    /**
     * @var string Group Overlay image url
     */
    protected $url = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Bound Ground overlay bound
     */
    protected $bound = null;

    /**
     * @var array Ground overlay options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GroundOverlayOptions
     */
    protected $options = array();

    /**
     * Create a ground overlay
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('ground_overlay_');
        
        $this->bound = new Bound();
        $this->bound->setNorthEast(new Coordinate());
        $this->bound->setSouthWest(new Coordinate());
    }

    /**
     * Gets the ground overlay image url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the ground overlay image url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the ground overlay bound
     *
     * @return Ivory\GoogleMapBundle\Model\Bound
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the ground overlay bound
     *
     * @param Ivory\GoogleMapBundle\Model\Bound $bound
     */
    public function setBound(Bound $bound)
    {
        $this->bound = $bound;
    }

    /**
     * Gets the ground overlay options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the ground overlay options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge(
            $this->options,
            $options
        );
    }

    /**
     * Get a specific ground overlay option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific ground overlay option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
}
