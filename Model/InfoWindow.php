<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Info window which describes a google map info window
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends AbstractAsset
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Coordinate Info window position
     */
    protected $position = null;

    /**
     * @var string Info window content
     */
    protected $content = '<p>Default content</p>';

    /**
     * @var array Info window options
     * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindowOptions
     */
    protected $options = array();
    
    /**
     * @var boolean TRUE if the info window is open else FALSE
     */
    protected $open = true;

    /**
     * Create an info window
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setPrefixJavascriptVariable('info_window_');
    }

    /**
     * Gets the infow window position
     *
     * @return Ivory\GoogleMapBundle\Model\Coordinate
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the info window position
     *
     * @param Ivory\GoogleMapBundle\Model\Coordinate $position
     */
    public function setPosition(Coordinate $position)
    {
        $this->position = $position;
    }

    /**
     * Gets the info window content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the info window content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Gets the info window options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the info windows options
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
     * Gets a specific info window option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        return isset($this->options[$option]) ? $this->options[$option] : null;
    }

    /**
     * Sets a specific info window option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        $this->options[$option] = $value;
    }
    
    /**
     * Checks if the info window is open
     *
     * @return boolean TRUE if the info window is open else FALSE
     */
    public function isOpen()
    {
        return $this->open;
    }
    
    /**
     * Set if the info window is open
     *
     * @param boolean $open TRUE if the info window is open else FALSE
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }
}
