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

use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder;

/**
 * Marker cluster builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerClusterBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Overlays\MarkerClusterBuilder */
    protected $markerClusterBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerClusterBuilder = new MarkerClusterBuilder('Ivory\GoogleMap\Overlays\MarkerCluster');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerClusterBuilder);
    }

    public function testInitialState()
    {
        $this->assertNull($this->markerClusterBuilder->getPrefixJavascriptVariable());
        $this->assertNull($this->markerClusterBuilder->getType());
        $this->assertEmpty($this->markerClusterBuilder->getMarkers());
        $this->assertEmpty($this->markerClusterBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $markerCluster = $this->markerClusterBuilder->build();

        $this->assertSame('marker_cluster_', substr($markerCluster->getJavascriptVariable(), 0, 15));
        $this->assertSame(MarkerCluster::_DEFAULT, $markerCluster->getType());
        $this->assertEmpty($markerCluster->getMarkers());
        $this->assertEmpty($markerCluster->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->markerClusterBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType(MarkerCluster::MARKER_CLUSTER)
            ->setMarkers(array($marker))
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->markerClusterBuilder->getPrefixJavascriptVariable());
        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $this->markerClusterBuilder->getType());
        $this->assertSame(array($marker), $this->markerClusterBuilder->getMarkers());
        $this->assertSame(array('foo' => 'bar'), $this->markerClusterBuilder->getOptions());

        $markerCluster = $this->markerClusterBuilder->build();

        $this->assertSame('foo', substr($markerCluster->getJavascriptVariable(), 0, 3));
        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $markerCluster->getType());
        $this->assertSame(array($marker), $markerCluster->getMarkers());
        $this->assertSame(array('foo' => 'bar'), $markerCluster->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->markerClusterBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType(MarkerCluster::MARKER_CLUSTER)
            ->setMarkers(array($marker))
            ->setOptions(array('foo' => 'bar'));

        $markerCluster1 = $this->markerClusterBuilder->build();
        $markerCluster2 = $this->markerClusterBuilder->build();

        $this->assertNotSame($markerCluster1, $markerCluster2);

        $this->assertSame('foo', substr($markerCluster1->getJavascriptVariable(), 0, 3));
        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $markerCluster1->getType());
        $this->assertSame(array($marker), $markerCluster1->getMarkers());
        $this->assertSame(array('foo' => 'bar'), $markerCluster1->getOptions());

        $this->assertSame('foo', substr($markerCluster2->getJavascriptVariable(), 0, 3));
        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $markerCluster2->getType());
        $this->assertSame(array($marker), $markerCluster2->getMarkers());
        $this->assertSame(array('foo' => 'bar'), $markerCluster2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->markerClusterBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setType(MarkerCluster::MARKER_CLUSTER)
            ->setMarkers(array($marker))
            ->setOptions(array('foo' => 'bar'));

        $markerCluster1 = $this->markerClusterBuilder->build();
        $this->markerClusterBuilder->reset();
        $markerCluster2 = $this->markerClusterBuilder->build();

        $this->assertNotSame($markerCluster1, $markerCluster2);

        $this->assertSame('foo', substr($markerCluster1->getJavascriptVariable(), 0, 3));
        $this->assertSame(MarkerCluster::MARKER_CLUSTER, $markerCluster1->getType());
        $this->assertSame(array($marker), $markerCluster1->getMarkers());
        $this->assertSame(array('foo' => 'bar'), $markerCluster1->getOptions());

        $this->assertSame('marker_cluster_', substr($markerCluster2->getJavascriptVariable(), 0, 15));
        $this->assertSame(MarkerCluster::_DEFAULT, $markerCluster2->getType());
        $this->assertEmpty($markerCluster2->getMarkers());
        $this->assertEmpty($markerCluster2->getOptions());
    }
}
