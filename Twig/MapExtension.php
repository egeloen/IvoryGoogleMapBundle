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

use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapExtension extends \Twig_Extension
{
    /**
     * @var MapHelper
     */
    private $mapHelper;

    /**
     * @param MapHelper $mapHelper
     */
    public function __construct(MapHelper $mapHelper)
    {
        $this->mapHelper = $mapHelper;
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
     * @param Map      $map
     * @param string[] $attributes
     *
     * @return string
     */
    public function render(Map $map, array $attributes = [])
    {
        $map->addHtmlAttributes($attributes);

        return $this->mapHelper->render($map);
    }

    /**
     * @param Map      $map
     * @param string[] $attributes
     *
     * @return string
     */
    public function renderHtml(Map $map, array $attributes = [])
    {
        $map->addHtmlAttributes($attributes);

        return $this->mapHelper->renderHtml($map);
    }

    /**
     * @param Map $map
     *
     * @return string
     */
    public function renderStylesheet(Map $map)
    {
        return $this->mapHelper->renderStylesheet($map);
    }

    /**
     * @param Map $map
     *
     * @return string
     */
    public function renderJavascript(Map $map)
    {
        return $this->mapHelper->renderJavascript($map);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }

    /**
     * @return string[]
     */
    private function getMapping()
    {
        return [
            'ivory_google_map'           => 'render',
            'ivory_google_map_container' => 'renderHtml',
            'ivory_google_map_css'       => 'renderStylesheet',
            'ivory_google_map_js'        => 'renderJavascript',
        ];
    }
}
