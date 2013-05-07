<?php

namespace Alterway\Bundle\RestHalBundle\EventListener;

use Alterway\Bundle\RestHalBundle\ApiResource\ResourceInterface;
use Alterway\Bundle\RestHalBundle\Controller\Annotations\Hal;
use Alterway\Bundle\RestHalBundle\Response\HalResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResourceListener
{
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();

        if ('json' !== $request->getRequestFormat()) {
            return;
        }

        if (!$request->attributes->has('_hal_config')) {
            return;
        }

        $annotation = $request->attributes->get('_hal_config');

        if (!$annotation instanceof Hal) {
            return;
        }

        $resource = $event->getControllerResult();

        if (!$resource instanceof ResourceInterface) {
            return;
        }

        $event->setResponse(new HalResponse($resource, $annotation->code));
    }
}
