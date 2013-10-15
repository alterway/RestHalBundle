<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

abstract class Resource implements ResourceInterface
{
    /**
     * @var ProxyResource
     */
    protected $hal;

    /**
     * @var RouterInterface
     */
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        $this->hal = new ProxyResource();
    }

    public function addLink($rel, $route, array $routeParams = array(), array $attributes = array())
    {
        $this->hal->addLink($rel, $this->generate($route, $routeParams), null,
            array_merge($attributes, array('method' => reset($this->router->getRouteCollection()->get($route)->getMethods()))));
        return $this;
    }

    public function addResource($rel, ResourceInterface $resource = null)
    {
        $this->hal->addResource($rel, $resource->getHal());
        return $this;
    }

    public function addSingleResource($rel, ResourceInterface $resource = null)
    {
        $this->hal->addSingleResource($rel, $resource->getHal());
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
        $this->setUri($this->generateUri());
        return $this->hal;
    }

    public function generate($title, $params)
    {
        return $this->router->generate($title, $params);
    }

    abstract protected function prepare();
    abstract protected function generateUri();
}