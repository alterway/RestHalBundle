<?php

namespace Alterway\DemoBundle\ApiResource;

use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class UserResource extends Resource
{

    public function __construct(\Alterway\DemoBundle\Entity\User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    protected function prepare()
    {
        $this->addLink('next', '/users?page=2');
        $this->addLink('search', '/users?id={user_id}');
    }

    protected function generateUri()
    {
        return "url to generate the hal resource's self link";
    }
}
