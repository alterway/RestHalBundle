<?php

namespace Alterway\Bundle\HalRestBundle\Response;

use Alterway\Bundle\HalRestBundle\ApiResource\ResourceInterface;
use Symfony\Component\HttpFoundation\Response;

class HalResponse extends Response implements HalResponseInterface
{

    public function __construct(ResourceInterface $resource, $status = 200, $headers = array())
    {
        parent::__construct($resource->asJson(), $status, $headers);
    }

}