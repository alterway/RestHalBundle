<?php

namespace Alterway\DemoBundle\Controller;

use Alterway\Bundle\RestHalBundle\Controller\Annotations\Hal;
use Alterway\Bundle\RestHalBundle\Response\HalResponse;
use Alterway\DemoBundle\ApiResource\UserResource;
use Alterway\DemoBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{

    /**
     * @Hal(code="200")
     */
    public function userWithAnnotateAction(Request $request)
    {
        $user = new User;
        return new UserResource($request, $user);
    }

    public function userWithoutAnnotateAction(Request $request)
    {
        $user = new User;

        $resource = new UserResource($request, $user);
        return new HalResponse($resource, 200);
    }

}