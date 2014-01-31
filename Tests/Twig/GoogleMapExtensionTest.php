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

/**
 * Google map extension test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Twig_Environment */
    protected $twig;

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

        $this->twig = new \Twig_Environment(new \Twig_Loader_String());
        $this->twig->addExtension(new GoogleMapExtension($this->templateHelperMock));
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->templateHelperMock);
        unset($this->twig);
    }

    public function testRenderMap()
    {
        $map = $this->createMap();

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderMap')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->twig->render('{{ google_map(map) }}', array('map' => $map)));
    }

    public function testRenderHtmlContainer()
    {
        $map = $this->createMap();

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderHtmlContainer')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->twig->render('{{ google_map_container(map) }}', array('map' => $map)));
    }

    public function testRenderJavasripts()
    {
        $map = $this->createMap();

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderJavascripts')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->twig->render('{{ google_map_js(map) }}', array('map' => $map)));
    }

    public function testRenderStylesheets()
    {
        $map = $this->createMap();

        $this->templateHelperMock
            ->expects($this->once())
            ->method('renderStylesheets')
            ->with($this->equalTo($map))
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->twig->render('{{ google_map_css(map) }}', array('map' => $map)));
    }

    /**
     * Creates a map.
     *
     * @return \Ivory\GoogleMap\Map The map.
     */
    protected function createMap()
    {
        return $this->getMock('Ivory\GoogleMap\Map');
    }
}
