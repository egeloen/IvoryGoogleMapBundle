<?php

/*
 * This file is part of the Ivory Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Templating\Helper;

use Ivory\GoogleMap\Helper\MapHelper;
use Symfony\Component\Templating\Helper\Helper;

class GoogleMapHelper extends Helper
{
    /**@var \Ivory\GoogleMap\Helper\MapHelper */
    protected $mapHelper;

    /**
     * Create the google map php template helper.
     *
     * @param \Ivory\GoogleMap\Helper\MapHelper $mapHelper The map helper.
     */
    public function __construct(MapHelper $mapHelper)
    {
        $this->mapHelper = $mapHelper;
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
