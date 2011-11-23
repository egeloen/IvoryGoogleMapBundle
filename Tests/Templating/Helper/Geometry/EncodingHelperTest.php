<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Geometry;

use Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper;

/**
 * EncodingHelper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingHelperTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Geometry\EncodingHelper
     */
    protected static $encodingHelper = null;
    
    /**
     * @override
     */
    public function setUp()
    {
        self::$encodingHelper = new EncodingHelper();
    }
    
    /**
     * Checks the render decode path method
     */
    public function testRenderDecodePath()
    {
        $this->assertEquals(self::$encodingHelper->renderDecodePath('value'), 'google.maps.geometry.encoding.decodePath("value")');
    }
}
