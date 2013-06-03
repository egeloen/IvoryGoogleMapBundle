<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Twig;

use Ivory\GoogleMapBundle\Twig\GoogleMapExtension;
use Twig_Environment;
use Twig_Loader_String;

/**
 * Google map extension test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Twig\GoogleMapExtension */
    protected $googleMapExtension;

    /** @var \Ivory\GoogleMapBundle\Templating\Helper\TemplateHelper */
    protected $templateHelperMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->templateHelperMock = $this->getMockBuilder('Ivory\GoogleMapBundle\Helper\TemplateHelper')
            ->disableOriginalConstructor()
            ->getMock();

        $this->googleMapExtension = new GoogleMapExtension($this->templateHelperMock);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->googleMapExtension);
        unset($this->templateHelperMock);
    }

    public function testRenderContainer()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderHtmlContainer')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->googleMapExtension->renderHtmlContainer($map));
    }

    public function testRenderJavascripts()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderJavascripts')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->googleMapExtension->renderJavascripts($map));
    }

    public function testRenderStylesheets()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderStylesheets')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->googleMapExtension->renderStylesheets($map));
    }

    public function testGoogleMapContainerFunction()
    {
        $twig = new Twig_Environment(new Twig_Loader_String());
        $twig->addExtension($this->googleMapExtension);

        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderHtmlContainer')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $twig->render('{{ google_map_container(map) }}', array('map' => $map)));
    }

    public function testGoogleMapJsFunction()
    {
        $twig = new Twig_Environment(new Twig_Loader_String());
        $twig->addExtension($this->googleMapExtension);

        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderJavascripts')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $twig->render('{{ google_map_js(map) }}', array('map' => $map)));
    }

    public function testGoogleMapCssFunction()
    {
        $twig = new Twig_Environment(new Twig_Loader_String());
        $twig->addExtension($this->googleMapExtension);

        $map = $this->getMock('Ivory\GoogleMap\Map');

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderStylesheets')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $twig->render('{{ google_map_css(map) }}', array('map' => $map)));
    }
}
