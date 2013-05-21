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

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helper\MapHelper;
use Twig_Function_Method;

/**
 * Ivory google map twig extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtension extends \Twig_Extension
{
    /**@var \Ivory\GoogleMap\Helper\MapHelper */
    protected $mapHelper;

    /**
     * @var array
     */
    protected $availablePlugins = array(
        'infobox' => '/bundles/ivorygooglemap/js/infobox.js'
    );

    /**
     * Create the google map twig extension.
     *
     * @param \Ivory\GoogleMap\Helper\MapHelper $mapHelper The map helper.
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
            'google_map_container' => 'renderHtmlContainer',
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
     * Renders the google map html container.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     *
     * @return string The html output.
     */
    public function renderHtmlContainer(Map $map)
    {
        return $this->mapHelper->renderHtmlContainer($map);
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
    public function renderJavascripts(Map $map, $plugins = array())
    {
        foreach($plugins as $key => $plugin) {
            if(in_array($plugin, array_keys($this->availablePlugins))) {
                $plugins[$plugin] = $this->availablePlugins[$plugin];
                unset($plugins[$key]);
            }
        }

        return $this->mapHelper->renderJavascripts($map, $plugins);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
}
