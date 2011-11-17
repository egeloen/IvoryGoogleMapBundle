<?php

namespace Ivory\GoogleMapBundle\Model\Services;

use Buzz\Browser;

/**
 * Abstract class for accesing google API
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractService 
{
    /**
     * @var Buzz\Browser Buzz browser 
     */
    protected $browser = null;
    
    /**
     * @var string Service API url
     */
    protected $url = null;
    
    /**
     * @var boolean TRUE if the service uses HTTPS else FALSE
     */
    protected $https = false;
    
    /**
     * @var string Format used by the service
     */
    protected $format = 'json';
    
    /**
     * Creates a service
     * 
     * @param string $url Service url
     * @param boolean $https TRUE if the service uses HTTPS else FALSE
     * @param string $format Format used by the service
     * @param Buzz\Browser $browser Buzz browser used by the service
     */
    public function __construct($url, $https = false, $format = 'json', Browser $browser = null)
    {
        $this->setUrl($url);
        $this->setHttps($https);
        $this->setFormat($format);
        is_null($browser) ? $this->browser = new Browser() : $this->browser = $browser;
    }
    
    /**
     * Gets the buzz browser
     *
     * @return Buzz\Browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }
    
    /**
     * Gets the service API url according to the https flag
     *
     * @return string
     */
    public function getUrl()
    {
        if($this->isHttps())
            return str_replace('http://', 'https://', $this->url);
        else
            return $this->url;
    }
    
    /**
     * Sets the service API url
     *
     * @param string $url 
     */
    public function setUrl($url)
    {
        if(is_string($url))
            $this->url = $url;
        else
            throw new \InvalidArgumentException('The service url must be a string value.');
    }
    
    /**
     * Checks if the service uses HTTPS
     *
     * @return boolean TRUE if the service uses HTTPS else FALSE
     */
    public function isHttps()
    {
        return $this->https;
    }
    
    /**
     * Sets the service HTTPS flag
     *
     * @param boolean $https TRUE if the service uses HTTPS else FALSE
     */
    public function setHttps($https)
    {
        if(is_bool($https))
            $this->https = $https;
        else
            throw new \InvalidArgumentException('The service https flag must be a boolean value.');
    }
    
    /**
     * Gets the service format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
    
    /**
     * Sets the service format
     *
     * @param string $format 
     */
    public function setFormat($format)
    {
        $availableFormats = array('json', 'xml');
        
        if(in_array($format, $availableFormats))
            $this->format = $format;
        else
            throw new \InvalidArgumentException('The service format can only be : '.implode(', ', $availableFormats));
    }
}
