<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;


interface ResourceInterface
{

    public function addLink($rel, $uri, $title = null, array $attributes = array());

    public function addResource($rel, ResourceInterface $resource = null);

    public function setData(array $data);

    public function setUri($uri);

    public function asJson($pretty = false);
}
