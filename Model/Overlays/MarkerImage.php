<?php

namespace Ivory\GoogleMapBundle\Model\Overlays;

use Ivory\GoogleMapBundle\Model\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMapBundle\Model\Base\Point;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Marker image which describes a google map marker image
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerImage
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImage extends AbstractJavascriptVariableAsset
{
    /**
     * @var string URL of the marker image
     */
    protected $url = '//maps.gstatic.com/mapfiles/markers/marker.png';

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Point Anchor of the marker image
     */
    protected $anchor = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Point Origin of the marker image
     */
    protected $origin = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Size Scaled size of the marker image
     */
    protected $scaledSize = null;

    /**
     * @var Ivory\GoogleMapBundle\Model\Base\Size Size of the marker image
     */
    protected $size = null;

    /**
     * Create a marker image
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('marker_image_');
    }

    /**
     * Gets the url of the marker image
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url of the marker image
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        if(is_string($url))
            $this->url = $url;
        else
            throw new \InvalidArgumentException('The url of a maker image must be a string value.');
    }

    /**
     * Checks if the marker image has an anchor
     *
     * @return boolean TRUE if the marker image has an anchor else FALSE
     */
    public function hasAnchor()
    {
        return !is_null($this->anchor);
    }

    /**
     * Gets the anchor of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Point
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Sets the anchor of the marker image
     *
     * Available prototype:
     *
     * public function setAnchor(double x, double y)
     * public function setAnchor(Ivory\GoogleMapBundle\Model\Base\Point $anchor = null)
     */
    public function setAnchor()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->anchor === null)
                $this->anchor = new Point();

            $this->anchor->setX($args[0]);
            $this->anchor->setY($args[1]);
        }
        else if($args[0] instanceof Point)
            $this->anchor = $args[0];
        else if(!isset($args[0]))
            $this->anchor = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The anchor setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setAnchor(double x, double y)',
                ' - public function setAnchor(Ivory\GoogleMapBundle\Model\Base\Point $anchor)'));
    }

    /**
     * Checks if the marker image has an origin
     *
     * @return boolean TRUE if the marker image has an origin else FALSE
     */
    public function hasOrigin()
    {
        return !is_null($this->origin);
    }

    /**
     * Gets the origin of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Point
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin of the marker image
     *
     * Available prototype:
     *
     * public function setOrigin(double x, double y)
     * public function setOrigin(Ivory\GoogleMapBundle\Model\Base\Point $origin = null)
     */
    public function setOrigin()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->origin === null)
                $this->origin = new Point();

            $this->origin->setX($args[0]);
            $this->origin->setY($args[1]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Point))
            $this->origin = $args[0];
        else if(!isset($args[0]))
            $this->origin = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The anchor setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setOrigin(double x, double y)',
                ' - public function setOrigin(Ivory\GoogleMapBundle\Model\Base\Point $origin)'));
    }

    /**
     * Checks if the marker image has a scaled size else FALSE
     *
     * @return boolean TRUE if the marker image has a scaled size else FALSE
     */
    public function hasScaledSize()
    {
        return !is_null($this->scaledSize);
    }

    /**
     * Gets the scaled size of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Size
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * Sets the scaled size of the marker image
     *
     * Available prototype:
     *
     * public function setScaledSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     * public function setScaledSize(Ivory\GoogleMapBundle\Model\Base\Size $scaledSize = null)
     */
    public function setScaledSize()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->scaledSize === null)
                $this->scaledSize = new Size();

            $this->scaledSize->setWidth($args[0]);
            $this->scaledSize->setHeight($args[1]);

            if(isset($args[2]) && is_string($args[2]))
                $this->scaledSize->setWidthUnit($args[2]);

            if(isset($args[3]) && is_string($args[3]))
                $this->scaledSize->setHeightUnit($args[3]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Size))
            $this->scaledSize = $args[0];
        else if(!isset($args[0]))
            $this->scaledSize = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The anchor setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setScaledSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)',
                ' - public function setScaledSize(Ivory\GoogleMapBundle\Model\Base\Size $scaledSize)'));
    }

    /**
     * Checks if the marker image has a size
     *
     * @return boolean TRUE if the marker image has a size else FALSE
     */
    public function hasSize()
    {
        return !is_null($this->size);
    }

    /**
     * Gets the size of the marker image
     *
     * @return Ivory\GoogleMapBundle\Model\Base\Size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size of the marker image
     *
     * Available prototype:
     *
     * public function setSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)
     * public function setSize(Ivory\GoogleMapBundle\Model\Base\Size $size = null)
     */
    public function setSize()
    {
        $args = func_get_args();

        if(isset($args[0]) && is_numeric($args[0]) && isset($args[1]) && is_numeric($args[1]))
        {
            if($this->size === null)
                $this->size = new Size($args[0], $args[1]);

            $this->size->setWidth($args[0]);
            $this->size->setHeight($args[1]);

            if(isset($args[2]) && is_string($args[2]))
                $this->size->setWidthUnit($args[2]);

            if(isset($args[3]) && is_string($args[3]))
                $this->size->setHeightUnit($args[3]);
        }
        else if(isset($args[0]) && ($args[0] instanceof Size))
            $this->size = $args[0];
        else if(!isset($args[0]))
            $this->size = null;
        else
            throw new \InvalidArgumentException(sprintf('%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
                'The anchor setter arguments is invalid.',
                'The available prototypes are :',
                ' - public function setSize(double $width, double $height, string $widthUnit = null, string $heightUnit = null)',
                ' - public function setSize(Ivory\GoogleMapBundle\Model\Base\Size $size)'));
    }
}
