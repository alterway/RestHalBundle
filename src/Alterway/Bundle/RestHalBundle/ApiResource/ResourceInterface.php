<?php

namespace Alterway\Bundle\RestHalBundle\ApiResource;


interface ResourceInterface
{

    /**
     * Adds a link to the Resource.
     *
     * @return Resource
     * @throws RouteNotFoundException              If the named route doesn't exist
     * @throws MissingMandatoryParametersException When some parameters are missing that are mandatory for the route
     * @throws InvalidParameterException           When a parameter value for a placeholder is not correct because
     *                                             it does not match the requirement
     */
    public function addLink($rel, $route, array $routeParams = array(), array $attributes = array());

    public function addResource($rel, ResourceInterface $resource = null);

    public function setData(array $data);

    public function setUri($uri);

    public function asJson($pretty = false);
}
