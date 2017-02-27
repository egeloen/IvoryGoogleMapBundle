<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Twig;

use Ivory\GoogleMap\Helper\StaticMapHelper;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapExtension extends \Twig_Extension
{
    /**
     * @var StaticMapHelper
     */
    private $staticMapHelper;

    /**
     * @param StaticMapHelper $staticMapHelper
     */
    public function __construct(StaticMapHelper $staticMapHelper)
    {
        $this->staticMapHelper = $staticMapHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $functions = [];

        foreach ($this->getMapping() as $name => $method) {
            $functions[] = new \Twig_SimpleFunction($name, [$this, $method], ['is_safe' => ['html']]);
        }

        return $functions;
    }

    /**
     * @param Map $map
     *
     * @return string
     */
    public function render(Map $map)
    {
        return $this->staticMapHelper->render($map);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map_static';
    }

    /**
     * @return string[]
     */
    private function getMapping()
    {
        return ['ivory_google_map_static' => 'render'];
    }
}
