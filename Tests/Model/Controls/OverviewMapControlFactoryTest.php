<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model\Controls;

use Ivory\GoogleMapBundle\Model\Controls\OverviewMapControlFactory;

/**
 * Overview map control factory test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\Controls\OverviewMapControlFactory */
    protected $overviewMapControlFactory;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overviewMapControlFactory = new OverviewMapControlFactory();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overviewMapControlFactory);
    }

    public function testCreateWithDefaultValue()
    {
        $overviewMapControl = $this->overviewMapControlFactory->create();

        $this->assertFalse($overviewMapControl->isOpened());
    }

    public function testCreateWithInitialValue()
    {
        $overviewMapControl = $this->overviewMapControlFactory->create(true);

        $this->assertTrue($overviewMapControl->isOpened());
    }
}
