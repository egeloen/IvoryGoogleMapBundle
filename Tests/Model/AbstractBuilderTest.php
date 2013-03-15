<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Tests\Model;

/**
 * Abstract builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMapBundle\Model\AbstractBuilder */
    protected $builder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->builder = $this->getMockBuilder('Ivory\GoogleMapBundle\Model\AbstractBuilder')
            ->setConstructorArgs(array('\stdClass'))
            ->getMockForAbstractClass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->builder);
    }

    public function testInitialState()
    {
        $this->assertSame('\stdClass', $this->builder->getClass());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The class "foo" does not exist.
     */
    public function testClassWithInvalidValue()
    {
        $this->builder->setClass('foo');
    }
}
