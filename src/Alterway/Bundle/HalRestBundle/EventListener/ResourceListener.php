<?php

namespace Alterway\Bundle\HalRestBundle\EventListener;

use Alterway\Bundle\HalRestBundle\ApiResource\ResourceInterface;
use Alterway\Bundle\HalRestBundle\Controller\Annotations\Hal;
use Alterway\Bundle\HalRestBundle\Response\HalResponse;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use ReflectionClass;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ResourceListener
{

    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Guesses the template name to render and its variables and adds them to
     * the request object.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {

        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }
        list($object, $method) = $controller;

        if ('json' !== $event->getRequest()->attributes->get('_format')) {
            return;
        }

        $className = ClassUtils::getClass($object);
        class_exists('\Alterway\Bundle\HalRestBundle\Controller\Annotations\Hal');
        $reflectionClass = new ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $allAnnotations = $this->reader->getMethodAnnotations($reflectionMethod);

        $halAnnotations = array_filter($allAnnotations, function($annotation) {
                    return $annotation instanceof Hal
                    ;
                }
        );

        foreach ($halAnnotations as $annotation) {
            $event->getRequest()->attributes->set('hal.rest', true);
            $event->getRequest()->attributes->set('hal.type', $annotation->type);
            $event->getRequest()->attributes->set('hal.code', $annotation->code);
        }
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {

        $request = $event->getRequest();
        $resource = $event->getControllerResult();

        if ($request->getRequestFormat() != 'json') {
            return;
        }
        if (!$request->attributes->get('hal.rest')) {
            return;
        }
        if (!$resource instanceof ResourceInterface) {
            return;
        }

        // only do something when the client accepts "text/html" as response format
        if (false === strpos($request->headers->get('Accept'), 'text/html')) {
            return;
        }

        $type = $request->attributes->get('hal.type');
        $code = $request->attributes->get('hal.code');
        $headers = array('Content-type' => $type);
        $response = new HalResponse($resource, $code, $headers);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -128),
            KernelEvents::VIEW => 'onKernelView'
        );
    }

}
