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
use Ivory\GoogleMapBundle\Helper\TemplateHelper;
use Twig_Function_Method;

/**
 * Ivory google map twig extension.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtension extends \Twig_Extension
{
    /** @var \Ivory\GoogleMapBundle\Templating\Helper\TemplateHelper */
    protected $templateHelper;

    /**
     * Create the google map twig extension.
     *
     * @param \Ivory\GoogleMapBundle\Helper\TemplateHelper $templateHelper The template helper.
     */
    public function __construct(TemplateHelper $templateHelper)
    {
        $this->templateHelper = $templateHelper;
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
        return $this->templateHelper->renderHtmlContainer($map);
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
        return $this->templateHelper->renderStylesheets($map);
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
        return $this->templateHelper->renderJavascripts($map);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
}
