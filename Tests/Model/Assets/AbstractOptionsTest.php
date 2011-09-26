<?php

namespace Ivory\GoogleMapBundle\Tests\Model\Assets;

/**
 * Abstract options asset test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOptionsAssetTest extends AbstractJavascriptVariableAssetTest
{
    /**
     * @var Ivory\GoogleMapBundle\Model\Assets\AbstractOptionsAsset Abstract options asset
     */
    protected static $object = null;
    
    /**
     * Checks the default values
     */
    public function testDefaultValues()
    {
        $this->assertEquals(count(self::$object->getOptions()), 0);
    }
    
    /**
     * Checks the options getter & setter
     */
    public function testOptions()
    {
        $validOptionsTest = array(
            'option1' => 'value1',
            'option2' => 'value2'
        );
        
        self::$object->setOptions($validOptionsTest);
        $this->assertEquals(count(self::$object->getOptions()), 2);
        
        $invalidOptionsTest = array(
            0 => 'value1',
            1 => 'value2'
        );
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->setOptions($invalidOptionsTest);
        
        $this->assertEquals(self::$object->getOption('option1'), 'value1');
        
        $this->setExpectedException('InvalidArgumentException');
        self::$object->getOption(0);
    }
}
