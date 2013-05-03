<?php
require_once __DIR__.'/autoload.php';
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
class AppKernel extends Kernel
{

    /**
    * @return array
    */
    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Alterway\Bundle\HalRestBundle\AwHalRestBundle(),
            new Alterway\DemoBundle\AlterwayDemoBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new Symfony\Bundle\AsseticBundle\AsseticBundle()
        );
    }

    /**
    * @return null
    */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    /**
    * @return string
    */
    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/AwHalRestBundle/cache';
    }

    /**
    * @return string
    */
    public function getLogDir()
    {
        return sys_get_temp_dir() . '/AwHalRestBundle/logs';
    }

}