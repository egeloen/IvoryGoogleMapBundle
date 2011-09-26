<?php

namespace Ivory\GoogleMapBundle\Model\Assets;

/**
 * Allow easy generation of unique javascript variable for any class model that required it
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJavascriptVariableAsset
{
    /**
     * @var string Javascript variable which describes the asset
     */
    protected $javascriptVariable = null;

    /**
     * Sets the prefix javascript variable off the javascript variable
     *
     * @param string $prefixJavascriptVariable
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        if(is_string($prefixJavascriptVariable))
            $this->javascriptVariable = uniqid($prefixJavascriptVariable);
        else
            throw new \InvalidArgumentException('The prefix of a javascript variable must be a string value.');
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
        if(is_string($javascriptVariable))
            $this->javascriptVariable = $javascriptVariable;
        else
            throw new \InvalidArgumentException('The javascript variable must be a string value.');
    }
}


?>
