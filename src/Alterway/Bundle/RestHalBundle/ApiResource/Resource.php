<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;

use Symfony\Component\HttpFoundation\Request;

abstract class Resource implements ResourceInterface
{

    protected $hal;
    protected $request;

    public function __construct(Request $request)
    {
        $this->hal = new ProxyResource($this->generateUri());
        $this->request = $request;
    }

    public function addLink($rel, $uri, $title = null, array $attributes = array())
    {
        $this->hal->addLink($rel, $uri, $title, $attributes);
        return $this;
    }

    public function addResource($rel, ResourceInterface $resource = null)
    {
        $this->hal->addResource($rel, $resource->getHal());
        return $this;
    }

    public function setData(array $data)
    {
        $this->hal->setData($data);
        return $this;
    }

    public function setUri($uri)
    {
        $this->hal->setUri($uri);
        return $this;
    }

    public function asJson($pretty = false)
    {
        return $this->getHal()->asJson($pretty);
    }

    public function getHal()
    {
        $this->prepare();
        return $this->hal;
    }

    abstract protected function prepare();
    abstract protected function generateUri();
}