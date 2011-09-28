<?php

namespace Ivory\GoogleMapBundle\Tests\Templating\Helper\Overlays;

use Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerImageHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\PointHelper;
use Ivory\GoogleMapBundle\Templating\Helper\Base\SizeHelper;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerImage;
use Ivory\GoogleMapBundle\Model\Base\Point;
use Ivory\GoogleMapBundle\Model\Base\Size;

/**
 * Marker image helper test
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\Overlays\MarkerImageHelper
     */
    protected static $markerImageHelper = null;
    
    /**
     * @override
     */
    protected function setUp()
    {
        self::$markerImageHelper = new MarkerImageHelper(new PointHelper(), new SizeHelper());
    }
    
    /**
     * Checks the render method
     */
    public function testRender()
    {
        $markerImageTest = new MarkerImage();
        $markerImageTest->setUrl('url');
        $markerImageTest->setSize(new Size(1, 2));
        $markerImageTest->setOrigin(new point(3, 4));
        $markerImageTest->setAnchor(new Point(5, 6));
        $markerImageTest->setScaledSize(new Size(7, 8));
        
        $this->assertEquals(self::$markerImageHelper->render($markerImageTest), 
            'var '.$markerImageTest->getJavascriptVariable().' = new google.maps.MarkerImage("url");'.PHP_EOL.
            $markerImageTest->getJavascriptVariable().'.size = new google.maps.Size(1, 2);'.PHP_EOL.
            $markerImageTest->getJavascriptVariable().'.origin = new google.maps.Point(3, 4);'.PHP_EOL.
            $markerImageTest->getJavascriptVariable().'.anchor = new google.maps.Point(5, 6);'.PHP_EOL.
            $markerImageTest->getJavascriptVariable().'.scaledSize = new google.maps.Size(7, 8);'.PHP_EOL
        );
    }
}
