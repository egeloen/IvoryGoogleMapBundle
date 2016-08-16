<?php

/*
 * This file is part of the Ivory Google Api bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMapBundle\Twig;

use Ivory\GoogleMap\Helper\ApiHelper;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ApiExtension extends \Twig_Extension
{
    /**
     * @var ApiHelper
     */
    private $apiHelper;

    /**
     * @param ApiHelper $apiHelper
     */
    public function __construct(ApiHelper $apiHelper)
    {
        $this->apiHelper = $apiHelper;
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
     * @param object[] $objects
     *
     * @return string
     */
    public function render(array $objects)
    {
        return $this->apiHelper->render($objects);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ivory_google_api';
    }

    /**
     * @return string[]
     */
    private function getMapping()
    {
        return ['ivory_google_api' => 'render'];
    }
}
