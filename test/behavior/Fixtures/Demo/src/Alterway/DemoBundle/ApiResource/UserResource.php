<?php

namespace Alterway\DemoBundle\ApiResource;

use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class UserResource extends Resource
{

    public function __construct(\Symfony\Component\HttpFoundation\Request $request, \Alterway\DemoBundle\Entity\User $user)
    {
        parent::__construct($request);
        $this->user = $user;
    }

    public function prepare()
    {
        $this->addLink('next', '/orders?page=2');
        $this->addLink('search', '/orders?id={order_id}');
    }

    protected function generateUri()
    {
        return "url to generate";
    }
}
