<?php

namespace Ivory\GoogleMapBundle\Twig;

use Ivory\GoogleMapBundle\Templating\Helper\MapHelper;
use Ivory\GoogleMapBundle\Model\Map;

/**
 * Ivory google map twig extension
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GoogleMapExtension extends \Twig_Extension
{
    /**
     * @var Ivory\GoogleMapBundle\Templating\Helper\MapHelper $mapHelper
     */
    protected $mapHelper = null;

    /**
     * Create a google map twig extension
     *
     * @param Ivory\GoogleMapBundle\Templating\Helper\MapHelper $mapHelper
     */
    public function __construct(MapHelper $mapHelper)
    {
        $this->mapHelper = $mapHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_map';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $mapping = array(
            'google_map_container' => 'renderContainer',
            'google_map_css'       => 'renderStylesheets',
            'google_map_js'        => 'renderJavascripts'
        );

        $functions = array();
        foreach($mapping as $twig => $local)
            $functions[$twig] = new \Twig_Function_Method($this, $local, array('is_safe' => array('html')));

        return $functions;
    }

    /**
     * Renders the google map container
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderContainer(Map $map)
    {
        return $this->mapHelper->renderContainer($map);
    }

    /**
     * Renders the google map stylesheets
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderStylesheets(Map $map)
    {
        return $this->mapHelper->renderStylesheets($map);
    }

    /**
     * Renders the google map javascripts
     *
     * @param Ivory\GoogleMapBundle\Model\Map $map
     * @return string HTML output
     */
    public function renderJavascripts(Map $map)
    {
        return $this->mapHelper->renderJavascripts($map);
    }
}
