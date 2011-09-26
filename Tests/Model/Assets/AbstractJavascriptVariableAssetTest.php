<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Assets;

/**
 * Abstract javascript variable asset test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractJavascriptVariableAssetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks the javascript variable getter & setter
     */
    abstract public function testJavascriptVariable();
}
