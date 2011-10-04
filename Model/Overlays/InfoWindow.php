<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset;
use Ivory\GoogleMapBundle\Model\Base\Coordinate;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Info window which describes a google map info window
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#InfoWindow
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindow extends AbstractOptionsAsset implements IExtendable
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Coordinate Info window position
     */
    protected $position = null;
    
    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Size Info window pixel offset
     */
    protected $pixedOffset = null;

    /**
     * @var string Info window content
     */
    protected $content = '<p>Default content</p>';
    
    /**
     * @var boolean TRUE if the info window is open else FALSE
     */
    protected $open = true;

    /**
     * Create an info window
     */
    public function __construct()
    {
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
     * public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position = null)
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
        else if(!isset($args[0]))
            $this->position = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The position setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setPosition(Ivory\GoogleMapBundle\Model\Base\Coordinate $position)',
                ' - public function setPosition(double $latitude, double $longitude, boolean $noWrap = true)'));
    }
    
    /**
     * Gets the pixel offset
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Size
     */
    public function getPixelOffset()
    {
        return $this->pixedOffset;
    }
    
    /**
     * Sets the pixel offset
     * 
     * Available prototype :
     * 
     * - public function setPixelOffset(double $width, double $height, string $widthUnit = null, string $heightUnit = null)',
     * - public function setPixelOffset(Ivory\GoogleMapBundle\Model\Base\Size $scaledSize)
     */
    public function setPixelOffset()
    {
        $args = func_get_args();
        
        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->pixedOffset === null)
                $this->pixedOffset = new Size();
            
            $this->pixedOffset->setWidth($args[0]);
            $this->pixedOffset->setHeight($args[1]);
            
            if(isset($args[2]) && is_string($args[2]))
                $this->pixedOffset->setWidthUnit($args[2]);
            
            if(isset($args[3]) && is_string($args[3]))
                $this->pixedOffset->setHeightUnit($args[3]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Size))
            $this->pixedOffset = $args[0];
        else if(!isset($args[0]))
            $this->pixedOffset = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The pixel offset setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setPixelOffset(double $width, double $height, string $widthUnit = null, string $heightUnit = null)',
                ' - public function setPixelOffset(Ivory\GoogleMapBundle\Model\Base\Size $scaledSize)'));
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
