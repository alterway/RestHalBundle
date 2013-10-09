<?php

namespace Alterway\Bundle\RestHalBundle\Renderer;

use Nocarrier\HalJsonRenderer;

class ProxyRenderer extends HalJsonRenderer
{
    /**
     * Return an array (compatible with the hal+json format) representing associated resources
     *
     * @param mixed $resources
     * @return array
     */
    protected function resourcesForJson($resources)
    {
        if(!is_array($resources)) {
            return $this->arrayForJson($resources);

        }

        return parent::resourcesForJson($resources);
    }
}