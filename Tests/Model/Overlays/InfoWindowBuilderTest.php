<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Overlays;

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Ivory\GoogleMapBundle\Model\Base\SizeBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder;

/**
 * Info window builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder */
    protected $infoWindowBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /** @var \Ivory\GoogleMapBundle\Model\Base\SizeBuilder */
    protected $sizeBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Ivory\GoogleMap\Base\Coordinate');
        $this->sizeBuilder = new SizeBuilder('Ivory\GoogleMap\Base\Size');

        $this->infoWindowBuilder = new InfoWindowBuilder(
            'Ivory\GoogleMap\Overlays\InfoWindow',
            $this->coordinateBuilder,
            $this->sizeBuilder
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->infoWindowBuilder);
        unset($this->coordinateBuilder);
        unset($this->sizeBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Ivory\GoogleMap\Overlays\InfoWindow', $this->infoWindowBuilder->getClass());
        $this->assertSame($this->coordinateBuilder, $this->infoWindowBuilder->getCoordinateBuilder());
        $this->assertSame($this->sizeBuilder, $this->infoWindowBuilder->getSizeBuilder());
        $this->assertNull($this->infoWindowBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->infoWindowBuilder->getContent());
        $this->assertEmpty($this->infoWindowBuilder->getPosition());
        $this->assertEmpty($this->infoWindowBuilder->getPixelOffset());
        $this->assertNull($this->infoWindowBuilder->isOpen());
        $this->assertNull($this->infoWindowBuilder->getOpenEvent());
        $this->assertNull($this->infoWindowBuilder->isAutoOpen());
        $this->assertNull($this->infoWindowBuilder->isAutoClose());
        $this->assertEmpty($this->infoWindowBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $infoWindow = $this->infoWindowBuilder->build();

        $this->assertSame('info_window_', substr($infoWindow->getJavascriptVariable(), 0, 12));
        $this->assertSame('<p>Default content</p>', $infoWindow->getContent());
        $this->assertNull($infoWindow->getPosition());
        $this->assertNull($infoWindow->getPixelOffset());
        $this->assertFalse($infoWindow->isOpen());
        $this->assertSame(MouseEvent::CLICK, $infoWindow->getOpenEvent());
        $this->assertTrue($infoWindow->isAutoOpen());
        $this->assertFalse($infoWindow->isAutoClose());
        $this->assertEmpty($infoWindow->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->infoWindowBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setContent('bar')
            ->setPosition(1, 2, false)
            ->setPixelOffset(3, 4, 'px', 'pt')
            ->setOpen(true)
            ->setOpenEvent(MouseEvent::DBLCLICK)
            ->setAutoOpen(false)
            ->setAutoClose(true)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->infoWindowBuilder->getPrefixJavascriptVariable());
        $this->assertSame('bar', $this->infoWindowBuilder->getContent());
        $this->assertSame(array(1, 2, false), $this->infoWindowBuilder->getPosition());
        $this->assertSame(array(3, 4, 'px', 'pt'), $this->infoWindowBuilder->getPixelOffset());
        $this->assertTrue($this->infoWindowBuilder->isOpen());
        $this->assertSame(MouseEvent::DBLCLICK, $this->infoWindowBuilder->getOpenEvent());
        $this->assertFalse($this->infoWindowBuilder->isAutoOpen());
        $this->assertTrue($this->infoWindowBuilder->isAutoClose());
        $this->assertSame(array('foo' => 'bar'), $this->infoWindowBuilder->getOptions());

        $infoWindow = $this->infoWindowBuilder->build();

        $this->assertSame('foo', substr($infoWindow->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $infoWindow->getContent());

        $this->assertSame(1, $infoWindow->getPosition()->getLatitude());
        $this->assertSame(2, $infoWindow->getPosition()->getLongitude());
        $this->assertFalse($infoWindow->getPosition()->isNoWrap());

        $this->assertSame(3, $infoWindow->getPixelOffset()->getWidth());
        $this->assertSame(4, $infoWindow->getPixelOffset()->getHeight());
        $this->assertSame('px', $infoWindow->getPixelOffset()->getWidthUnit());
        $this->assertSame('pt', $infoWindow->getPixelOffset()->getHeightUnit());

        $this->assertTrue($infoWindow->isOpen());
        $this->assertSame(MouseEvent::DBLCLICK, $infoWindow->getOpenEvent());
        $this->assertFalse($infoWindow->isAutoOpen());
        $this->assertTrue($infoWindow->isAutoClose());
        $this->assertSame(array('foo' => 'bar'), $infoWindow->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->infoWindowBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setContent('bar')
            ->setPosition(1, 2, false)
            ->setPixelOffset(3, 4, 'px', 'pt')
            ->setOpen(true)
            ->setOpenEvent(MouseEvent::DBLCLICK)
            ->setAutoOpen(false)
            ->setAutoClose(true)
            ->setOptions(array('foo' => 'bar'));

        $infoWindow1 = $this->infoWindowBuilder->build();
        $infoWindow2 = $this->infoWindowBuilder->build();

        $this->assertNotSame($infoWindow1, $infoWindow2);

        $this->assertSame('foo', substr($infoWindow1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $infoWindow1->getContent());

        $this->assertSame(1, $infoWindow1->getPosition()->getLatitude());
        $this->assertSame(2, $infoWindow1->getPosition()->getLongitude());
        $this->assertFalse($infoWindow1->getPosition()->isNoWrap());

        $this->assertSame(3, $infoWindow1->getPixelOffset()->getWidth());
        $this->assertSame(4, $infoWindow1->getPixelOffset()->getHeight());
        $this->assertSame('px', $infoWindow1->getPixelOffset()->getWidthUnit());
        $this->assertSame('pt', $infoWindow1->getPixelOffset()->getHeightUnit());

        $this->assertTrue($infoWindow1->isOpen());
        $this->assertSame(MouseEvent::DBLCLICK, $infoWindow1->getOpenEvent());
        $this->assertFalse($infoWindow1->isAutoOpen());
        $this->assertTrue($infoWindow1->isAutoClose());
        $this->assertSame(array('foo' => 'bar'), $infoWindow1->getOptions());

        $this->assertSame('foo', substr($infoWindow2->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $infoWindow2->getContent());

        $this->assertSame(1, $infoWindow2->getPosition()->getLatitude());
        $this->assertSame(2, $infoWindow2->getPosition()->getLongitude());
        $this->assertFalse($infoWindow2->getPosition()->isNoWrap());

        $this->assertSame(3, $infoWindow2->getPixelOffset()->getWidth());
        $this->assertSame(4, $infoWindow2->getPixelOffset()->getHeight());
        $this->assertSame('px', $infoWindow2->getPixelOffset()->getWidthUnit());
        $this->assertSame('pt', $infoWindow2->getPixelOffset()->getHeightUnit());

        $this->assertTrue($infoWindow2->isOpen());
        $this->assertSame(MouseEvent::DBLCLICK, $infoWindow2->getOpenEvent());
        $this->assertFalse($infoWindow2->isAutoOpen());
        $this->assertTrue($infoWindow2->isAutoClose());
        $this->assertSame(array('foo' => 'bar'), $infoWindow2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->infoWindowBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setContent('bar')
            ->setPosition(1, 2, false)
            ->setPixelOffset(3, 4, 'px', 'pt')
            ->setOpen(true)
            ->setOpenEvent(MouseEvent::DBLCLICK)
            ->setAutoOpen(false)
            ->setAutoClose(true)
            ->setOptions(array('foo' => 'bar'));

        $infoWindow1 = $this->infoWindowBuilder->build();
        $this->infoWindowBuilder->reset();
        $infoWindow2 = $this->infoWindowBuilder->build();

        $this->assertSame('foo', substr($infoWindow1->getJavascriptVariable(), 0, 3));
        $this->assertSame('bar', $infoWindow1->getContent());

        $this->assertSame(1, $infoWindow1->getPosition()->getLatitude());
        $this->assertSame(2, $infoWindow1->getPosition()->getLongitude());
        $this->assertFalse($infoWindow1->getPosition()->isNoWrap());

        $this->assertSame(3, $infoWindow1->getPixelOffset()->getWidth());
        $this->assertSame(4, $infoWindow1->getPixelOffset()->getHeight());
        $this->assertSame('px', $infoWindow1->getPixelOffset()->getWidthUnit());
        $this->assertSame('pt', $infoWindow1->getPixelOffset()->getHeightUnit());

        $this->assertTrue($infoWindow1->isOpen());
        $this->assertSame(MouseEvent::DBLCLICK, $infoWindow1->getOpenEvent());
        $this->assertFalse($infoWindow1->isAutoOpen());
        $this->assertTrue($infoWindow1->isAutoClose());
        $this->assertSame(array('foo' => 'bar'), $infoWindow1->getOptions());

        $this->assertSame('info_window_', substr($infoWindow2->getJavascriptVariable(), 0, 12));
        $this->assertSame('<p>Default content</p>', $infoWindow2->getContent());
        $this->assertNull($infoWindow2->getPosition());
        $this->assertNull($infoWindow2->getPixelOffset());
        $this->assertFalse($infoWindow2->isOpen());
        $this->assertSame(MouseEvent::CLICK, $infoWindow2->getOpenEvent());
        $this->assertTrue($infoWindow2->isAutoOpen());
        $this->assertFalse($infoWindow2->isAutoClose());
        $this->assertEmpty($infoWindow2->getOptions());
    }
}
