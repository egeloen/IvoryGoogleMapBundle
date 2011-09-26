<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Base\Coordinate;

/**
 * Info window which describes a google map info window
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends AbstractAsset implements IExtendable
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Info window position
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
     * @return Ivory\GoogleMapBundle\Model\Base\Coordinate
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the info window position
     *
     * Available prototype:
     * 
     * public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position)
     * public function setPosition(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function setPosition()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->position === null)
                $this->position = new Coordinate();
            
            $this->position->setLatitude($args[0]);
            $this->position->setLongitude($args[1]);
            
            if(isset($args[2]) && is_bool($args[2]))
                $this->position->setNoWrap($args[2]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Coordinate))
            $this->position = $args[0];
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The position setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position)',
                ' - public function setPosition(double $latitude, double $longitude, boolean $noWrap = true)'));
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
        if(is_string($content))
            $this->content = $content;
        else
            throw new \InvalidArgumentException('The content of an info window must be a string value.');
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
        foreach($options as $option => $value)
            $this->setOption($option, $value);
    }

    /**
     * Gets a specific info window option
     *
     * @param string $option
     * @return mixed
     */
    public function getOption($option)
    {
        if(is_string($option))
            return isset($this->options[$option]) ? $this->options[$option] : null;
        else
            throw new \InvalidArgumentException('The option property of an info window must be a string value.');
    }

    /**
     * Sets a specific info window option
     *
     * @param string $option
     * @param mixed $value
     */
    public function setOption($option, $value)
    {
        if(is_string($option))
            $this->options[$option] = $value;
        else
            throw new \InvalidArgumentException('The option property of an info window must be a string value.');
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
        if(is_bool($open))
            $this->open = $open;
        else
            throw new \InvalidArgumentException('The open property of a circle must be a boolean value.');
    }
}
