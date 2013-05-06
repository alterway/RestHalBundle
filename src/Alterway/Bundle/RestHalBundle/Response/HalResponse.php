<?php

namespace Alterway\Bundle\RestHalBundle\Response;

use Alterway\Bundle\RestHalBundle\ApiResource\ResourceInterface;
use Symfony\Component\HttpFoundation\Response;

class HalResponse extends Response implements HalResponseInterface
{

    public function __construct(ResourceInterface $resource, $status = 200, $headers = array())
    {
        parent::__construct($resource->asJson(), $status, $headers);
    }

}