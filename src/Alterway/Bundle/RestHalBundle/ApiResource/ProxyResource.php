<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;

use Alterway\Bundle\RestHalBundle\Renderer\ProxyRenderer;
use Nocarrier\Hal;

class ProxyResource extends Hal
{

    public function setData(array $array)
    {
        $this->data = $array;
        return $this;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Add an embedded resource, identified by $rel and represented by $resource.
     *
     * @param string $rel
     * @param Hal $resource
     * @return ProxyResource
     */
    public function addSingleResource($rel, Hal $resource = null)
    {
        $this->resources[$rel] = $resource;
        return $this;
    }

    /**
     * Return the current object in a application/hal+json format (links and resources)
     *
     * @param bool $pretty Enable pretty-printing
     * @return string
     */
    public function asJson($pretty=false)
    {
        $renderer = new ProxyRenderer();
        return $renderer->render($this, $pretty);
    }
}