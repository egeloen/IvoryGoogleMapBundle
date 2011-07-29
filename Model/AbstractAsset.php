<?php

namespace Ivory\GoogleMapBundle\Model;

/**
 * Allow easy generation of unique javascript variable for any class model that required it
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractAsset
{
    /**
     * @var string Javascript variable which describes the asset
     */
    protected $javascriptVariable;
    
    /**
     * Create an asset
     */
    public function __construct()
    {
        $this->javascriptVariable = null;
    }

    /**
     * Sets the prefix javascript variable off the javascript variable
     *
     * @param string $prefixJavascriptVariable
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->javascriptVariable = uniqid($prefixJavascriptVariable);
    }

    /**
     * Gets the javascript variable which describes the asset
     *
     * @return string
     */
    public function getJavascriptVariable()
    {
        return $this->javascriptVariable;
    }

    /**
     * Sets the javascript variable which describes the asset
     *
     * @param string $javascriptVariable
     */
    public function setJavascriptVariable($javascriptVariable)
    {
        $this->javascriptVariable = $javascriptVariable;
    }
}
