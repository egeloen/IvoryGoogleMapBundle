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

use \Twig_Function_Method;

use Ivory\GoogleMap\Map,
    Ivory\GoogleMap\Templating\Helper\MapHelper;

/**
 * Ivory google map twig extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtension extends \Twig_Extension
{
    /**@var \Ivory\GoogleMap\Templating\Helper\MapHelper */
    protected $mapHelper;

    /**
     * Create the google map twig extension.
     *
     * @param \Ivory\GoogleMap\Templating\Helper\MapHelper $mapHelper The map helper.
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
        $mapping = array(
            'google_map_container' => 'renderContainer',
            'google_map_css'       => 'renderStylesheets',
            'google_map_js'        => 'renderJavascripts',
        );

        $functions = array();
        foreach ($mapping as $twig => $local) {
            $functions[$twig] = new Twig_Function_Method($this, $local, array('is_safe' => array('html')));
        }

        return $functions;
    }

    /**
     * Renders the google map container.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderContainer(Map $map)
    {
        return $this->mapHelper->renderContainer($map);
    }

    /**
     * Renders the google map stylesheets.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderStylesheets(Map $map)
    {
        return $this->mapHelper->renderStylesheets($map);
    }

    /**
     * Renders the google map javascripts.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderJavascripts(Map $map)
    {
        return $this->mapHelper->renderJavascripts($map);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
}
