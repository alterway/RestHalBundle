<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;


interface ResourceInterface
{

    public function addLink($rel, $route, array $routeParams = array(), array $attributes = array());

    public function addResource($rel, ResourceInterface $resource = null);

    public function setData(array $data);

    public function setUri($uri);

    public function asJson($pretty = false);
}
